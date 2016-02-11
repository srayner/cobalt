<?php

namespace Project\Form;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Project\Hydrator\Strategy\NullStrategy;

class TaskFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        // Grab the entity manager.
        $em = $serviceLocator->get('Doctrine\ORM\EntityManager');
        
        // Set up a hydrator
        $hydrator = new DoctrineHydrator($em);
        $nullStrategy = new NullStrategy();
        $hydrator->addStrategy('estimatedHours', $nullStrategy);
        $hydrator->addStrategy('actualHours', $nullStrategy);
        
        // Create the form.
        $form = new TaskForm();
        $form->setHydrator($hydrator);
        return $form;
    }   
}