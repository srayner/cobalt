<?php

namespace Project\Service;

class MilestoneService
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
                    ->createQuery('SELECT COUNT(m.id) FROM Project\Entity\Milestone m')
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

    public function persist($milestone)
    {
        $this->entityManager->persist($milestone);
        $this->entityManager->flush();
    }

    public function remove($milestone)
    {
        $this->entityManager->remove($milestone);
        $this->entityManager->flush(); 
    }

}

