<?php

return array(
    
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
            'Cobalt\Controller\Computer' => 'Cobalt\Controller\ComputerController',
            'Cobalt\Controller\Enduser'  => 'Cobalt\Controller\UserController'
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
            'Cobalt\User' => 'Cobalt\Model\User\User'
        ),
        'factories' => array(
            'Cobalt\UserForm'   => 'Cobalt\Form\UserFormFactory'
        ),    
    ),
    
    // Cobalt
    'cobalt' => array (
        'computer_model_class'  => 'Cobalt\Model\Computer\Computer',
        'logical_disk_model_class'  => 'Cobalt\Model\LogicalDisk\LogicalDisk',
    )  
);
