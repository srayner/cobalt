<?php

namespace Project\Service;

class CommentService
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

    public function persist($comment)
    {
        $this->entityManager->persist($comment);
        $this->entityManager->flush();
    }

    public function remove($comment)
    {
        $this->entityManager->remove($comment);
        $this->entityManager->flush(); 
    }
}

