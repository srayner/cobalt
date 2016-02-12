<?php

namespace Project\Form;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Project\Form\MilestoneFilter;

class MilestoneFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $em = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $form = new MilestoneForm($em);
        $form->setInputFilter(new MilestoneFilter());
        $form->setHydrator(new DoctrineHydrator($em));
        return $form;
    }   
}