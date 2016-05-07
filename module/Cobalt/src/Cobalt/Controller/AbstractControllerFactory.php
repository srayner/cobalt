<?php

namespace Cobalt\Controller;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AbstractControllerFactory implements AbstractFactoryInterface
{
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {   
        return (fnmatch('*Controller*', $requestedName)) ? true : false;   
    }
    
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        $entityName = substr($requestedName, strrpos($requestedName, '\\') + 1);
        $className = $requestedName . 'Controller';
        $serviceName = 'Cobalt\\EntityService\\' . $entityName . 'Service';
        
        if (class_exists($className)) {
            $service = $serviceLocator->getServiceLocator()->get($serviceName);
            return new $className($service);
        }
        return false;
    }
    
}
