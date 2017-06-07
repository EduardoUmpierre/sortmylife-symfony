<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;

class BookService
{
    const ENTITY_NAME = 'AdminBundle:Book';

    private $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->em->getRepository(self::ENTITY_NAME)->findAll();
    }

    /**
     * @param $id
     * @return array
     */
    public function findAllByAuthorId($id)
    {
        return $this->em->getRepository(self::ENTITY_NAME)->findBy(['author' => $id]);
    }

    /**
     * @param $id
     * @return array
     */
    public function findOneById($id)
    {
        return $this->em->getRepository(self::ENTITY_NAME)->findOneBy(['id' => $id]);
    }
}