<?php

namespace Notification\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class IndexControllerFactory implements FactoryInterface
{ 
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = $serviceLocator->get('NotificationService');
        return new IndexController($service);
    }
}
