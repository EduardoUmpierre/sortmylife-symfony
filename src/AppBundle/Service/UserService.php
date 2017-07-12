<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;

class UserService
{
    const ENTITY_NAME = 'AdminBundle:User';

    private $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
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