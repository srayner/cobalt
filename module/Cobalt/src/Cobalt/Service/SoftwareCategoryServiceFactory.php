<?php

namespace Cobalt\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SoftwareCategoryServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $service = new SoftwareCategoryService($entityManager, 'Cobalt\Entity\SoftwareCategory');
        return $service;
    }   
}