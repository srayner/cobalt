<?php

namespace Cobalt\Controller;

use Zend\Mvc\Controller\AbstractActionController;

abstract class AbstractController extends AbstractActionController
{
    protected $entityManager;
    
    protected function getEntityManager()
    {
        if (null === $this->entityManager)
        {
            $this->entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->entityManager;
    }
}