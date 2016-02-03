<?php

namespace Project\Form;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Project\Hydrator\Strategy\NullStrategy;

class ProjectFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $em = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $form = new ProjectForm($em);
    //    $form->setInputFilter(new ProjectFilter());
        $hydrator = new DoctrineHydrator($em);
        $nullStrategy = new NullStrategy();
        $hydrator->addStrategy('estimatedHours', $nullStrategy);
        $hydrator->addStrategy('actualHours', $nullStrategy);
        $hydrator->addStrategy('estimatedCost', $nullStrategy);
        $hydrator->addStrategy('actualCost', $nullStrategy);
        $form->setHydrator($hydrator);
        return $form;
    }   
}