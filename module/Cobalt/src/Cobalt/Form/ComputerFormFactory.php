<?php

namespace Cobalt\Form;

use Cobalt\Model\Computer\ComputerHydrator;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ComputerFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new ComputerForm();
        $form->setInputFilter(new ComputerFilter());
        $form->setHydrator(new ComputerHydrator());
        return $form;
    }   
}