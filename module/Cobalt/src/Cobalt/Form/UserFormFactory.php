<?php

namespace Cobalt\Form;

use Cobalt\Model\User\UserHydrator;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new UserForm();
        $form->setInputFilter(new UserFilter());
        $form->setHydrator(new UserHydrator());
        return $form;
    }   
}