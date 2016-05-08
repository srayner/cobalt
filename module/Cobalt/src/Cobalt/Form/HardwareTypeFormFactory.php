<?php

namespace Cobalt\Form;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class HardwareTypeFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $form = new HardwareTypeForm();
        $form->setInputFilter(new HardwareTypeFilter());
        $form->setHydrator(new DoctrineHydrator($entityManager));
        return $form;
    }   
}