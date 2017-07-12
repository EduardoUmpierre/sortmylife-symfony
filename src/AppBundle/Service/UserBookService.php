<?php

namespace AppBundle\Service;

use AdminBundle\Entity\Book;
use AdminBundle\Entity\User;
use AdminBundle\Entity\UserBook;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserBookService
{
    const ENTITY_NAME = 'AdminBundle:UserBook';

    private $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param $user
     * @param $book
     * @return mixed
     */
    public function findOneByUserAndBook($user, $book)
    {
        return $this->em->getRepository(self::ENTITY_NAME)->findOneBy(['user' => $user, 'book' => $book]);
    }

    /**
     * @param User $user
     * @param Book $book
     */
    public function favorite(User $user, Book $book)
    {
        $userBook = self::findOneByUserAndBook($user->getId(), $book->getId());

        if ($userBook instanceof UserBook and !empty($userBook)) {
            $this->em->remove($userBook);
        } else {
            $userBook = new UserBook();
            $userBook->setUser($user);
            $userBook->setBook($book);

            $this->em->persist($userBook);
        }

        $this->em->flush();

        return;
    }
}