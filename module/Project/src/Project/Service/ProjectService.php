<?php

namespace Project\Service;

class ProjectService
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
                    ->createQuery('SELECT COUNT(p.id) FROM Project\Entity\Project p')
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
    
    public function persist($project)
    {
        $this->entityManager->persist($project);
        $this->entityManager->flush();
    }

    public function remove($project)
    {
        $this->entityManager->remove($project);
        $this->entityManager->flush(); 
    }

}

