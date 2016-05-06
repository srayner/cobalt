<?php

namespace Cobalt\Form;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class SoftwareCategoryFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $form = new SoftwareCategoryForm();
        $form->setInputFilter(new SoftwareCategoryFilter());
        $form->setHydrator(new DoctrineHydrator($entityManager));
        return $form;
    }   
}