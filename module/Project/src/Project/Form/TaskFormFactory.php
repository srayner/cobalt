<?php

namespace Project\Form;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class TaskFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $em = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $form = new TaskForm();
    //    $form->setInputFilter(new TaskFilter());
        $form->setHydrator(new DoctrineHydrator($em));
        return $form;
    }   
}