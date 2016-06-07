<?php

namespace Cobalt\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TicketServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $notificationService = $serviceLocator->get('NotificationService');
        $mailService = $serviceLocator->get('CivMail\MailService');
        $mailConfig = $serviceLocator->get('config')['cobalt']['email'];
        $service = new TicketService($entityManager, 'Cobalt\Entity\Ticket', $notificationService, $mailService, $mailConfig);
        return $service;
    }   
}