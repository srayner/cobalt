<?php

namespace FAQ\Service;

class QuestionService
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
    
    public function persist($question)
    {
        $this->entityManager->persist($question);
        $this->entityManager->flush();
    }

    public function remove($question)
    {
        $this->entityManager->remove($question);
        $this->entityManager->flush(); 
    }
}
