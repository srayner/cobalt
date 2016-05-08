<?php

namespace Cobalt\Form;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class HardwareTypeFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new HardwareTypeForm();
        $form->setInputFilter(new HardwareTypeFilter());
        return $form;
    }   
}