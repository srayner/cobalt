<?php

namespace Project\Form;

use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class ProjectFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $em = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $form = new ProjectForm($em);
    //    $form->setInputFilter(new ProjectFilter());
    //    $form->setHydrator(new ClassMethods());
        $form->setHydrator(new DoctrineHydrator($em));
        return $form;
    }   
}