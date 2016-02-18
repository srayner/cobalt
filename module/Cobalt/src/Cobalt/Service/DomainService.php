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
    
    public function findAll()
    {
        return $this->entityManager->getRepository($this->repository)->findAll();
    }
    
    public function findById()
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
