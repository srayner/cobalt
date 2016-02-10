<?php

namespace Cobalt\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ActiveDirectoryServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new ActiveDirectory;
        $options = $serviceLocator->get('Config')['cobalt']['ldap'];
        $service->setOptions($options);
        return $service;
    } 
}

