<?php

namespace Cobalt\Service;

class SoftwareManufacturerService
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

    public function persist($manufacturer)
    {
        $this->entityManager->persist($manufacturer);
        $this->entityManager->flush();
    }

    public function remove($manufacturer)
    {
        $this->entityManager->remove($manufacturer);
        $this->entityManager->flush(); 
    }

}