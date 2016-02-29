<?php

namespace Cobalt\Service;

class DomainService
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
                    ->createQuery('SELECT COUNT(d.id) FROM Cobalt\Entity\Domain d')
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
    
    public function persist($domain)
    {
        $this->entityManager->persist($domain);
        $this->entityManager->flush();
    }

    public function remove($domain)
    {
        $this->entityManager->remove($domain);
        $this->entityManager->flush(); 
    }
}
