<?php

namespace Cobalt\Service;

class OfficeService
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
