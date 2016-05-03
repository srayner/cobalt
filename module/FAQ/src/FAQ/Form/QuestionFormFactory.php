<?php

namespace FAQ\Form;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class QuestionFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $form = new QuestionForm();
        $form->setInputFilter(new QuestionFilter());
        $form->setHydrator(new DoctrineHydrator($entityManager));
        return $form;
    }   
}