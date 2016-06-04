<?php

namespace Notification\Service;

class NotificationService
{
    const REPOSITORY = 'Notification\Entity\Notification';
    
    private $entityManager;
    
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    public function findAll()
    {
        return $this->entityManager->getRepository($this::REPOSITORY)->findAll();
    }
}