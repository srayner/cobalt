<?php

namespace Cobalt\Service;

class CompanyService
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

    public function findById($id)
    {
        return $this->entityManager->find($this->repository, $id);
    }
    
    public function persist($company)
    {
        $this->entityManager->persist($company);
        $this->entityManager->flush();
    }

    public function remove($company)
    {
        $this->entityManager->remove($company);
        $this->entityManager->flush(); 
    }
}
