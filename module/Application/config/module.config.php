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
                ),
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
                    array(
                        'label' => 'Detail',
                        'controller' => 'company',
                        'action' => 'detail',
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
                'pages' => array(
                    
                    // Consumables.
                    array(
                        'label' => 'Consumables',
                        'controller' => 'consumable',
                        'action' => 'index',
                        'pages' => array(
                            array(
                                'label' => 'Add',
                                'controller' => 'consumable',
                                'action' => 'add',
                            ),
                            array(
                                'label' => 'Edit',
                                'controller' => 'consumable',
                                'action' => 'edit',
                            ),
                            array(
                                'label' => 'Delete',
                                'controller' => 'consumable',
                                'action' => 'delete',
                            ),
                            array(
                                'label' => 'Detail',
                                'controller' => 'consumable',
                                'action' => 'detail',
                            ),
                        ),
                    ),
                    
                    // Hardware types.
                    array(
                        'label' => 'Hardware Types',
                        'controller' => 'hardwaretype',
                        'action' => 'index',
                        'pages' => array(
                            array(
                                'label' => 'Add',
                                'controller' => 'hardwaretype',
                                'action' => 'add',
                            ),
                            array(
                                'label' => 'Edit',
                                'controller' => 'hardwaretype',
                                'action' => 'edit',
                            ),
                            array(
                                'label' => 'Delete',
                                'controller' => 'hardwaretype',
                                'action' => 'delete',
                            ),
                            array(
                                'label' => 'Detail',
                                'controller' => 'hardwaretype',
                                'action' => 'detail',
                            ),
                        ),
                    ),
                    
                    // Hardware statuses.
                    array(
                        'label' => 'Hardware Statuses',
                        'controller' => 'hardwarestatus',
                        'action' => 'index',
                        'pages' => array(
                            array(
                                'label' => 'Add',
                                'controller' => 'hardwarestatus',
                                'action' => 'add',
                            ),
                            array(
                                'label' => 'Edit',
                                'controller' => 'hardwarestatus',
                                'action' => 'edit',
                            ),
                            array(
                                'label' => 'Delete',
                                'controller' => 'hardwarestatus',
                                'action' => 'delete',
                            ),
                            array(
                                'label' => 'Detail',
                                'controller' => 'hardwarestatus',
                                'action' => 'detail',
                            ),
                        ),
                    ),
                
                    // Hardware manufacturers.
                    array(
                        'label' => 'Hardware Manufacturers',
                        'controller' => 'hardwaremanufacturer',
                        'action' => 'index',
                        'pages' => array(
                            array(
                                'label' => 'Add',
                                'controller' => 'hardwaremanufacturer',
                                'action' => 'add',
                            ),
                            array(
                                'label' => 'Edit',
                                'controller' => 'hardwaremanufacturer',
                                'action' => 'edit',
                            ),
                            array(
                                'label' => 'Delete',
                                'controller' => 'hardwaremanufacturer',
                                'action' => 'delete',
                            ),
                            array(
                                'label' => 'Detail',
                                'controller' => 'hardwaremanufacturer',
                                'action' => 'detail',
                            ),
                        ),
                    ),
                    
                    // Software types.
                    array(
                        'label' => 'Software Types',
                        'controller' => 'softwaretype',
                        'action' => 'index',
                        'pages' => array(
                            array(
                                'label' => 'Add',
                                'controller' => 'softwaretype',
                                'action' => 'add',
                            ),
                            array(
                                'label' => 'Edit',
                                'controller' => 'softwaretype',
                                'action' => 'edit',
                            ),
                            array(
                                'label' => 'Delete',
                                'controller' => 'softwaretype',
                                'action' => 'delete',
                            ),
                            array(
                                'label' => 'Detail',
                                'controller' => 'softwaretype',
                                'action' => 'detail',
                            ),
                        ),
                    ),
                    
                    // Software categories.
                    array(
                        'label' => 'Software Categories',
                        'controller' => 'softwarecategory',
                        'action' => 'index',
                        'pages' => array(
                            array(
                                'label' => 'Add',
                                'controller' => 'softwarecategory',
                                'action' => 'add',
                            ),
                            array(
                                'label' => 'Edit',
                                'controller' => 'softwarecategory',
                                'action' => 'edit',
                            ),
                            array(
                                'label' => 'Delete',
                                'controller' => 'softwarecategory',
                                'action' => 'delete',
                            ),
                            array(
                                'label' => 'Detail',
                                'controller' => 'softwarecategory',
                                'action' => 'detail',
                            ),
                        ),
                    ),
                    
                    // Software manufacturers.
                    array(
                        'label' => 'Software Manufacturers',
                        'controller' => 'softwaremanufacturer',
                        'action' => 'index',
                        'pages' => array(
                            array(
                                'label' => 'Add',
                                'controller' => 'softwaremanufacturer',
                                'action' => 'add',
                            ),
                            array(
                                'label' => 'Edit',
                                'controller' => 'softwaremanufacturer',
                                'action' => 'edit',
                            ),
                            array(
                                'label' => 'Delete',
                                'controller' => 'softwaremanufacturer',
                                'action' => 'delete',
                            ),
                            array(
                                'label' => 'Detail',
                                'controller' => 'softwaremanufacturer',
                                'action' => 'detail',
                            ),
                        ),
                    ),
                    
                    // Ticket types.
                    array(
                        'label' => 'Ticket Types',
                        'controller' => 'tickettype',
                        'action' => 'index',
                        'pages' => array(
                            array(
                                'label' => 'Add',
                                'controller' => 'tickettype',
                                'action' => 'add',
                            ),
                            array(
                                'label' => 'Edit',
                                'controller' => 'tickettype',
                                'action' => 'edit',
                            ),
                            array(
                                'label' => 'Delete',
                                'controller' => 'tickettype',
                                'action' => 'delete',
                            ),
                            array(
                                'label' => 'Detail',
                                'controller' => 'tickettype',
                                'action' => 'detail',
                            ),
                        ),
                    ),
                    
                    // Ticket statuses.
                    array(
                        'label' => 'Ticket Statuses',
                        'controller' => 'ticketstatus',
                        'action' => 'index',
                        'pages' => array(
                            array(
                                'label' => 'Add',
                                'controller' => 'ticketstatus',
                                'action' => 'add',
                            ),
                            array(
                                'label' => 'Edit',
                                'controller' => 'ticketstatus',
                                'action' => 'edit',
                            ),
                            array(
                                'label' => 'Delete',
                                'controller' => 'ticketstatus',
                                'action' => 'delete',
                            ),
                            array(
                                'label' => 'Detail',
                                'controller' => 'ticketstatus',
                                'action' => 'detail',
                            ),
                        ),
                    ),
                    
                    // Ticket categories.
                    array(
                        'label' => 'Ticket Categories',
                        'controller' => 'ticketcategory',
                        'action' => 'index',
                        'pages' => array(
                            array(
                                'label' => 'Add',
                                'controller' => 'ticketcategory',
                                'action' => 'add',
                            ),
                            array(
                                'label' => 'Edit',
                                'controller' => 'ticketcategory',
                                'action' => 'edit',
                            ),
                            array(
                                'label' => 'Delete',
                                'controller' => 'ticketcategory',
                                'action' => 'delete',
                            ),
                            array(
                                'label' => 'Detail',
                                'controller' => 'ticketcategory',
                                'action' => 'detail',
                            ),
                        ),
                    ),
                    
                    // Support Technicions.
                    array(
                        'label' => 'Support Technicians',
                        'controller' => 'user',
                        'action' => 'technicians',
                    ),
                
                ),
            ),
        ),
    ),
    
);
