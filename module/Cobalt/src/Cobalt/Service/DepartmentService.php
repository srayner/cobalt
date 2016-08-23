<?php

namespace Cobalt\Service;

class DepartmentService
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

    public function findAll()
    {
        return $this->entityManager->getRepository($this->repository)->findAll();
    }

    public function findById($id)
    {
        return $this->entityManager->find($this->repository, $id);
    }

    public function findByCompanyAndName($company, $name)
    {
        return $this->entityManager->getRepository($this->repository)->findOneBy(array(
            'company' => $company,
            'name' => $name
        ));
    }
    
    public function persist($department)
    {
        $this->entityManager->persist($department);
        $this->entityManager->flush();
    }

    public function remove($department)
    {
        $this->entityManager->remove($department);
        $this->entityManager->flush(); 
    }

}

