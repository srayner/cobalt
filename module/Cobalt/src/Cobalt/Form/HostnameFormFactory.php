<?php

namespace Cobalt\Form;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class HostnameFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new HostnameForm();
        $form->setInputFilter(new HostnameFilter());
        return $form;
    }   
}