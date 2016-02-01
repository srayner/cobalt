<?php

namespace Project\Service;

class TaskService
{
    private $entityManager;
    private $repository;
    
    public function __construct($entityManager, $repository)
    {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }
    
    public function count()
    {
        return $this->entityManager
                    ->createQuery('SELECT COUNT(p.id) FROM Project\Entity\Task p')
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

    public function persist($entity)
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function remove($entity)
    {
        $this->entityManager->remove($entity);
        $this->entityManager->flush(); 
    }

}

