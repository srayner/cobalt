<?php

namespace Cobalt\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class WMIServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new WMI($serviceLocator);
        $options = $serviceLocator->get('Config')['cobalt'];
        $service->setOptions($options);
        return $service;
    } 
}
