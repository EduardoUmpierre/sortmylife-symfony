<?php

namespace AdminBundle\Repository;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository  extends EntityRepository implements UserProviderInterface
{
    /**
     * @param string $username
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function loadUserByUsername($username)
    {
        return $this->getEntityManager()
            ->createQuery('
                SELECT u FROM AdminBundle:User u WHERE (u.username = :login OR u.email = :login) AND u.isActive = 1
            ')
            ->setParameters(['login' => $username])
            ->getOneOrNullResult();
    }

    /**
     * @param UserInterface $user
     * @return mixed
     */
    public function refreshUser(UserInterface $user)
    {
        return $this->find($user->getId());
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