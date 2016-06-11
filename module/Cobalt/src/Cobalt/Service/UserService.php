<?php

namespace Cobalt\Service;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;

class UserService implements EventManagerAwareInterface
{
    private $eventManager;
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
                    ->createQuery('SELECT COUNT(u.id) FROM Cobalt\Entity\User u')
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
    
    public function findBySamAccountName($samAccountName)
    {
        return $this->entityManager->getRepository($this->repository)
                ->findOneBy(array('samAccountName' => $samAccountName));
    }
    
    public function persist($user)
    {
        $function = 'add';
        if ($user->getId()) {
            $function = 'edit';
        }
        $params = compact('user');
        $this->getEventManager()->trigger($function, $this, $params);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        $this->getEventManager()->trigger($function . '.post', $this, $params);
    }

    public function remove($user)
    {
        $this->getEventManager()->trigger(__FUNCTION__, $this, $user);
        $this->entityManager->remove($user);
        $this->entityManager->flush(); 
        $this->getEventManager()->trigger(__FUNCTION__ . '.post', $this, $user);
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
