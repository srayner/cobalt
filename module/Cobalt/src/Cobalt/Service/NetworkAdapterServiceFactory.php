<?php

namespace Cobalt\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class NetworkAdapterServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $notificationService = $serviceLocator->get('NotificationService');
        $mailService = $serviceLocator->get('CivMail\MailService');
        $mailConfig = $serviceLocator->get('config')['cobalt']['email'];
        $service = new NetworkAdapterService($entityManager, 'Cobalt\Entity\NetworkAdapter', $notificationService, $mailService, $mailConfig);
        return $service;
    }   
}