<?php

namespace Cobalt\Service;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;

abstract class AbstractEntityService implements EventManagerAwareInterface
{
    protected $eventManager;
    protected $entityManager;
    protected $repository;
    
    public function __construct($entityManager, $repository)
    {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
    }
    
    public function findAll()
    {
        return $this->entityManager->getRepository($this->repository)->findAll();
    }

    public function findBy($conditions)
    {
        return $this->entityManager->getRepository($this->repository)->findBy($conditions);
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
    
    public function getReference($repository, $id)
    {
        return $this->entityManager->getReference($repository, $id);
    }
    
    public function getEventManager()
    {
        if (null === $this->eventManager) {
            $this->setEventManager(new EventManager());
        }
        return $this->eventManager;
    }

    public function setEventManager(EventManagerInterface $eventManager)
    {
        $eventManager->setIdentifiers(array(
            __CLASS__,
            get_called_class(),
        ));
        $this->eventManager = $eventManager;
        return $this;
        
    }
}
