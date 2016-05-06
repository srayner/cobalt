<?php

namespace Cobalt\Service;

class SoftwareCategoryService
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

    public function persist($category)
    {
        $this->entityManager->persist($category);
        $this->entityManager->flush();
    }

    public function remove($category)
    {
        $this->entityManager->remove($category);
        $this->entityManager->flush(); 
    }

}