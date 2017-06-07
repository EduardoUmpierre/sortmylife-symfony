<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;

class AuthorService
{
    const ENTITY_NAME = 'AdminBundle:Author';

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
    public function findOneById($id)
    {
        return $this->em->getRepository(self::ENTITY_NAME)->findOneBy(['id' => $id]);
    }
}