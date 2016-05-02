<?php

namespace Coablt\Service;

class officeService
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
    
    public function persist($office)
    {
        $this->entityManager->persist($office);
        $this->entityManager->flush();
    }

    public function remove($office)
    {
        $this->entityManager->remove($office);
        $this->entityManager->flush(); 
    }
}
