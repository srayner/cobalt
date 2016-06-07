<?php

namespace Notification\Service;

class NotificationService
{
    const REPOSITORY = 'Notification\Entity\Template';
    
    private $entityManager;
    
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    public function findAll()
    {
        return $this->entityManager->getRepository($this::REPOSITORY)->findAll();
    }
    
    public function find($id)
    {
        return $this->entityManager->find($this::REPOSITORY, $id);
    }
    
    public function findByName($name)
    {
        return $this->entityManager->getRepository($this::REPOSITORY)->findOneBy(array(
            'name' => $name
        ));
    }
    
    public function persist($notification)
    {
        $this->entityManager->persist($notification);
        $this->entityManager->flush();
    }
}