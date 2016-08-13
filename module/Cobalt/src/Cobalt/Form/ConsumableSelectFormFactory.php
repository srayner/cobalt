<?php

namespace Cobalt\Form;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class ConsumableSelectFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $form = new ConsumableSelectForm($entityManager);
        $form->setInputFilter(new ConsumableSelectFilter());
        $form->setHydrator(new DoctrineHydrator($entityManager));
        return $form;
    }   
}