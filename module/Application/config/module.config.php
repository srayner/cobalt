<?php

return array(
    
    'router' => array(
        'routes' => array(
            
            'admin' => array(
                'type'    => 'Literal',
                'priority' => 9000,
                'options' => array(
                    'route'    => '/admin',
                    
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'admin',
                    ),
                ),
            ),
            
            'dbconfig' => array(
                'type'    => 'Literal',
                'priority' => 9000,
                'options' => array(
                    'route'    => '/dbconfig',
                    
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'dbconfig',
                    ),
                ),
            ),
            
            'adconfig' => array(
                'type'    => 'Literal',
                'priority' => 9000,
                'options' => array(
                    'route'    => '/adconfig',
                    
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'adconfig',
                    ),
                ),
            ),
            
            'mailinconfig' => array(
                'type'    => 'Literal',
                'priority' => 9000,
                'options' => array(
                    'route'    => '/mailinconfig',
                    
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'mailinconfig',
                    ),
                ),
            ),
            
            'mailoutconfig' => array(
                'type'    => 'Literal',
                'priority' => 9000,
                'options' => array(
                    'route'    => '/mailoutconfig',
                    
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'mailoutconfig',
                    ),
                ),
            ),
            
            'help' => array(
                'type'    => 'Literal',
                'priority' => 9000,
                'options' => array(
                    'route'    => '/help',
                    
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'help',
                    ),
                ),
                
            ),
            
            'settings' => array(
                'type'    => 'Literal',
                'priority' => 9000,
                'options' => array(
                    'route'    => '/settings',
                    
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'settings',
                    ),
                ),
                
            )
        ),
        
    ),
    
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
        'factories' => array(
            'navigation'               => 'Zend\Navigation\Service\DefaultNavigationFactory',
            'Application\DbConfigForm' => 'Application\Form\DbConfigFormFactory',
            'Application\AdConfigForm' => 'Application\Form\AdConfigFormFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController'
        ),
    ),
    
    // View helpers
    'view_helpers' => array(
        'factories' => array(
            'ProfileMenu' => 'Application\View\Helper\ProfileMenuFactory',
        )
    ),
    
    // View manager config.
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/403'               => __DIR__ . '/../view/error/403.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
                'console' => array(
                    'type'    => 'simple',
                    'options' => array(
                        'route'    => 'test',
                        'defaults' => array(
                            '__NAMESPACE__' => 'Application\Controller',
                            'controller' => 'Application\Controller\Index',
                            'action'     => 'console'
                        )
                    )
                )
            ),
        ),
    ),
    
    // Navigation
    'navigation' => array(
        'default' => array(
            
            // Dashboard.
            array(
                'label' => '<i class="fa fa-area-chart"></i> Dashboard',
                'route' => 'cobalt',
             ),
            
            // Helpdesk
            array(
                'label' => '<i class="fa fa-life-ring"></i> Support Helpdesk',
                'route' => 'cobalt/default',
                'controller' => 'ticket',
                'pages' => array(
                    array(
                        'label' => 'New Ticket',
                        'controller' => 'ticket',
                        'action' => 'add',
                    ),
                    array(
                        'label' => 'Update Ticket',
                        'controller' => 'ticket',
                        'action' => 'edit',
                    ),
                    array(
                        'label' => 'Cancel Ticket',
                        'controller' => 'ticket',
                        'action' => 'cancel',
                    ),
                ),
            ),
            
            // Organisation
            array(
                'label' => '<i class="fa fa-building"></i> Organisation',
                'route' => 'cobalt/default',
                'controller' => 'company',
                'pages' => array(
                    array(
                        'label' => 'New Company',
                        'controller' => 'company',
                        'action' => 'add',
                    ),
                    array(
                        'label' => 'Edit',
                        'controller' => 'company',
                        'action' => 'edit',
                    ),
                    array(
                        'label' => 'Delete',
                        'controller' => 'company',
                        'action' => 'delete',
                    ),
                ),
            ),
            
            array(
                'label' => '<i class="fa fa-user"></i> Users',
                'route' => 'cobalt/default',
                'controller' => 'user',
                'pages' => array(
                    array(
                        'label' => 'New User',
                        'controller' => 'user',
                        'action' => 'add',
                    ),
                    array(
                        'label' => 'Edit',
                        'controller' => 'user',
                        'action' => 'edit',
                    ),
                    array(
                        'label' => 'Delete',
                        'controller' => 'user',
                        'action' => 'delete',
                    ),
                    array(
                        'label' => 'User Detail',
                        'controller' => 'user',
                        'action' => 'detail',
                    ),
                    array(
                        'label' => 'My Profile',
                        'controller' => 'CivUser\Controller\User',
                        'action' => 'profile',
                    ),
                    array(
                        'label' => 'Change Password',
                        'controller' => 'CivUser\Controller\User',
                        'action' => 'changepassword',
                    ),
                ),
            ),
            array(
                'label' => '<i class="fa fa-desktop"></i> Computers',
                'route' => 'cobalt/default',
                'controller' => 'computer',
                'pages' => array(
                    array(
                        'label' => 'New Computer',
                        'controller' => 'computer',
                        'action' => 'add',
                    ),
                    array(
                        'label' => 'Edit',
                        'controller' => 'computer',
                        'action' => 'edit',
                    ),
                    array(
                        'label' => 'Delete',
                        'controller' => 'computer',
                        'action' => 'delete',
                    ),
                ),
            ),
            array(
                'label' => '<i class="fa fa-print"></i> Printers',
                'route' => 'cobalt/default',
                'controller' => 'printer',
                'pages' => array(
                    array(
                        'label' => 'New Printer',
                        'controller' => 'printer',
                        'action' => 'add',
                    ),
                    array(
                        'label' => 'Edit Printer',
                        'controller' => 'printer',
                        'action' => 'edit',
                    ),
                    array(
                        'label' => 'Delete Printer',
                        'controller' => 'printer',
                        'action' => 'delete',
                    ),
                ),
            ),
            array(
                'label' => '<i class="fa fa-cubes"></i> Hardware',
                'route' => 'cobalt/default',
                'controller' => 'hardware',
                'pages' => array(
                    array(
                        'label' => 'Hardware Detail',
                        'controller' => 'hadware',
                        'action' => 'detail',
                    ),
                ),
            ),
            array(
                'label' => '<i class="fa fa-floppy-o"></i> Software',
                'route' => 'cobalt/default',
                'controller' => 'software',
            ),
            array(
                'label' => '<i class="fa fa-cubes"></i> Projects',
                'route' => 'project/default',
                'controller' => 'project',
                'pages' => array(
                    array(
                        'label' => 'Project Detail',
                        'controller' => 'project',
                        'action' => 'detail',
                    ),
                ),
            ),
            array(
                'label' => '<i class="fa fa-cloud"></i> Domains',
                'route' => 'cobalt/default',
                'controller' => 'domain',
            ),
            array(
                'label' => '<i class="fa fa-comment"></i> FAQ',
                'route' => 'faq/default',
                'controller' => 'index',
            ),
            array(
                'label' => '<i class="fa fa-cogs"></i> Admin',
                'route' => 'admin',
            ),
        ),
    ),
    
);
