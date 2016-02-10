<?php

namespace Cobalt\Service;

class UserService
{
    private $entityManager;
    private $repository;
    
    public function __construct($entityManager, $repository)
    {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
    }
    
    public function count()
    {
        return $this->entityManager
                    ->createQuery('SELECT COUNT(u.id) FROM Cobalt\Entity\User u')
                    ->getSingleScalarResult();
    }
    
    public function findAll()
    {
        return $this->entityManager->getRepository($this->repository)->findAll();
    }

    public function findById($id)
    {
        return $this->entityManager->find($this->repository, $id);
    }
    
    public function findBySamAccountName($samAccountName)
    {
        return $this->entityManager->getRepository($this->repository)
                ->findOneBy(array('samAccountName' => $samAccountName));
    }
    
    public function persist($user)
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function remove($user)
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush(); 
    }
}
