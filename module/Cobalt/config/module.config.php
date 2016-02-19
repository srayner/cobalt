<?php

namespace Cobalt;

use \Zend\Mvc\Controller\ControllerManager;

return array(

    // Doctrine
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ),
            ),
        ),
    ),
    
    // Router
    'router' => array(
        'routes' => array(
            
            'cobalt' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Cobalt\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => ':controller[/:action[/:id]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            
        ),
    ),
    
    // Controllers
    'controllers' => array(
        'invokables' => array(
            'Cobalt\Controller\Index'    => 'Cobalt\Controller\IndexController',
        ),
        'factories' => array(
            'Cobalt\Controller\Computer' => function(ControllerManager $cm) {
                $sm = $cm->getServiceLocator();
                $service = $sm->get('Cobalt\ComputerService');
                return new Controller\ComputerController($service);
            },  
            'Cobalt\Controller\Domain' => function(ControllerManager $cm) {
                $sm = $cm->getServiceLocator();
                $service = $sm->get('Cobalt\DomainService');
                return new Controller\DomainController($service);
            },  
            'Cobalt\Controller\User' => function(ControllerManager $cm) {
                $sm = $cm->getServiceLocator();
                $service = $sm->get('Cobalt\UserService');
                return new Controller\UserController($service);
            },     
        ),
    ),
    
    // View manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
  
    // console
    'console' => array(
        'router' => array(
            'routes' => array(
                'activity' => array(
                    'type'    => 'simple',
                    'options' => array(
                        'route'    => 'activity',
                        'defaults' => array(
                            '__NAMESPACE__' => 'Cobalt\Controller',
                            'controller' => 'Cobalt\Controller\Index',
                            'action'     => 'file'
                        ),
                    ),
                ),
                'files' => array(
                    'type'    => 'simple',
                    'options' => array(
                        'route'    => 'files',
                        'defaults' => array(
                            '__NAMESPACE__' => 'Cobalt\Controller',
                            'controller' => 'Cobalt\Controller\Index',
                            'action'     => 'files'
                        ),
                    ),
                ),
            ),
        ),
    ),
    
    // Service manger configuration.
    'service_manager' => array(
        'invokables' => array(
            'Cobalt\User'      => 'Cobalt\Entity\User',
            'Cobalt\Computer'  => 'Cobalt\Entity\Computer',
            'Cobalt\Domain'    => 'Cobalt\Entity\Domain',
            'WhoIsService'     => 'Cobalt\Service\WhoIsService',
            
        ),
        'factories' => array(
            'Cobalt\ActiveDirectoryService' => 'Cobalt\Service\ActiveDirectoryServiceFactory',
            'Cobalt\WMIService'             => 'Cobalt\Service\WMIServiceFactory',
            'Cobalt\DomainForm'             => 'Cobalt\Form\DomainFormFactory',
            'Cobalt\DomainService'          => 'Cobalt\Service\DomainServiceFactory',
            'Cobalt\UserForm'               => 'Cobalt\Form\UserFormFactory',
            'Cobalt\ComputerForm'           => 'Cobalt\Form\ComputerFormFactory',
            'Cobalt\ComputerService'        => 'Cobalt\Service\ComputerServiceFactory',
            'Cobalt\UserService'            => 'Cobalt\Service\UserServiceFactory',
        ),    
    ),
    
    // Cobalt
    'cobalt' => array (
        'computer_model_class'  => 'Cobalt\Model\Computer\Computer',
        'logical_disk_model_class'  => 'Cobalt\Model\LogicalDisk\LogicalDisk',
    )  
);
