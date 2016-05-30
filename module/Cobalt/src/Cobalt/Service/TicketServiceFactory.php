<?php

namespace Cobalt\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TicketServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $mailService = $serviceLocator->get('CivMail\MailService');
        $mailConfig = $serviceLocator->get('config')['cobalt']['email'];
        $service = new TicketService($entityManager, 'Cobalt\Entity\Ticket', $mailService, $mailConfig);
        return $service;
    }   
}