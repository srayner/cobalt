<?php

namespace Cobalt\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ActiveDirectoryServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new WMI;
        $options = $serviceLocator->get('Config')['cobalt'];
        $service->setOptions($options);
        return $service;
    } 
}
