<?php

namespace Cobalt\Service;

class SoftwareTypeService
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

    public function persist($type)
    {
        $this->entityManager->persist($type);
        $this->entityManager->flush();
    }

    public function remove($type)
    {
        $this->entityManager->remove($type);
        $this->entityManager->flush(); 
    }
}