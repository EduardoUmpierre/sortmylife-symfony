<?php
namespace AppBundle\Security\Core\User;

use AdminBundle\Entity\Tracker;
use AdminBundle\Entity\User;
use AppBundle\Service\NewsletterService;
use AppBundle\Service\TrackerService;
use AppBundle\Service\UserTrackerService;
use Doctrine\ORM\EntityManager;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class OAuthUserProvider implements OAuthAwareUserProviderInterface, UserProviderInterface
{
    const ENTITY_NAME = 'AdminBundle:User';

    protected $em;
    protected $factory;

    /**
     * @param EntityManager $em
     * @param EncoderFactory $factory
     */
    public function __construct(EntityManager $em, EncoderFactory $factory)
    {
        $this->em = $em;
        $this->factory = $factory;
    }

    /**
     * @param UserResponseInterface $response
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $data = $response->getResponse();

        $facebookId = $data['id'];
        $facebookEmail = isset($data['email']) ? $data['email'] : null;

        $query = $this->em->getRepository('AdminBundle:User')->createQueryBuilder('u')->where('u.facebookID = :fbId');

        if ($facebookEmail) {
            $query->orWhere('u.email = :fbEmail')
                ->setParameters(['fbId' => $facebookId, 'fbEmail' => $facebookEmail]);
        } else {
            $query->setParameter('fbId', $facebookId);
        }

        $existingUser = $query->setMaxResults(1)->getQuery()->getOneOrNullResult();

        if ($existingUser === null) {
            $user = new User();
            $user->setFacebookID($facebookId);
            $user->setUsername($facebookId);
            $user->setFullName($data['name']);
            $user->setEmail($facebookEmail);

            if ($data['picture'] && $data['picture']['data'] && !$data['picture']['data']['is_silhouette']) {
                $user->setFacebookImage($data['picture']['data']['url']);
            }

            $this->em->persist($user);
            $this->em->flush();

            $username = $data['first_name'] . $data['last_name'] . $user->getId() . mt_rand(0, 100);

            $user->setUsername($username);
            $this->em->flush();

            return $user;
        } else if (!$existingUser->getFacebookId()) {
            $existingUser->setFacebookId($facebookId);

            if ($data['picture'] && $data['picture']['data'] && !$data['picture']['data']['is_silhouette']) {
                $existingUser->setFacebookImage($data['picture']['data']['url']);
            }

            $this->em->flush();
        }

        if (!$existingUser->getEmail() && $facebookEmail) {
            $existingUser->setEmail($facebookEmail);

            $this->em->flush();
        }

        return $existingUser;
    }

    /**
     * @param string $username
     * @return mixed
     */
    public function loadUserByUsername($username)
    {
        return $this->em->getRepository(self::ENTITY_NAME)->loadUserByUsername($username);
    }


    /**
     * @param UserInterface $user
     * @return mixed
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->em->getRepository(self::ENTITY_NAME)->refreshUser($user);
    }

    /**
     * @param string $class
     * @return bool
     */
    public function supportsClass($class)
    {
        return $class === 'AdminBundle\Entity\User';
    }
}