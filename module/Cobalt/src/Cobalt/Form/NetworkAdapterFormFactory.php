<?php

namespace Cobalt\Form;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

/**
 * Factory class for creating and setting up a NetworkAdapterForm.
 * 
 * @author Steve Rayner <srayner02@gmail.com> 
 */
class NetworkAdapterFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $form = new NetworkAdapterForm();
        $form->setInputFilter(new NetworkAdapterFilter());
        $form->setHydrator(new DoctrineHydrator($entityManager));
        return $form;
    }

}
