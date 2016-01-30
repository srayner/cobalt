<?php

namespace Cobalt\Service;

class ComputerService implements ComputerServiceInterface
{
    private $entityManager;
    private $repository;
    
    public function __construct($entityManager, $repository)
    {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
    }

    public function count()
    {
        return $this->entityManager
                    ->createQuery('SELECT COUNT(c.id) FROM Cobalt\Entity\Computer c')
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

    public function findBySerial($serial)
    {
        return $this->entityManager->getRepository($this->repository)
                                   ->findOneBy(array('serialNumber' => $serial));
    }

    public function persist($computer)
    {
        $this->entityManager->persist($computer);
        $this->entityManager->flush();
    }

    public function remove($computer)
    {
        $this->entityManager->remove($computer);
        $this->entityManager->flush(); 
    }

}

