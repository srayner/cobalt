<?php

namespace Notification;

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
            
            'notification' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/notifications',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Notification\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
            ),
            
            'template' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/template/:id',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Notification\Controller',
                        'controller'    => 'Index',
                        'action'        => 'template',
                        'id'            => 0
                    ),
                ),
            ),
            
        ),
    ),
    
    // Controllers
    'controllers' => array(
        'factories' => array(
            'Notification\Controller\Index'    => 'Notification\Controller\IndexControllerFactory',
        )
    ),
    
    // View manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
      
    // Service manger configuration.
    'service_manager' => array(
        'invokables' => array(
            'Notification\Template'              => 'Notification\Entity\Template',
        ),
        'factories' => array(
            'Notification\TemplateForm' => 'Notification\Form\TemplateFormFactory',
            'NotificationService'       => 'Notification\Service\NotificationServiceFactory',
        )
    ),
);