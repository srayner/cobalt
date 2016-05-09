<?php

namespace Cobalt\Form;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class HardwareManufacturerFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $form = new HardwareManufacturerForm();
        $form->setInputFilter(new HardwareManufacturerFilter());
        $form->setHydrator(new DoctrineHydrator($entityManager));
        return $form;
    }   
}