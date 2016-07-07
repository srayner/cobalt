<?php

namespace Cobalt\Repository;

use Doctrine\ORM\EntityRepository;

class User extends EntityRepository
{
    public function findAdmins()
    {
        $dql = "select u from Cobalt\Entity\User u inner join u.roles r where r.name = 'admin'";
        $query = $this->_em->createQuery($dql);
        return $query->getResult();
    }
    
    public function findTechnicians()
    {
        $dql = "select u from Cobalt\Entity\User u inner join u.roles r where r.name = 'technician'";
        $query = $this->_em->createQuery($dql);
        return $query->getResult();
    }   
}