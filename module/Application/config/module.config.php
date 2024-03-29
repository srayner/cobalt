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
            'navigation'                 => 'Zend\Navigation\Service\DefaultNavigationFactory',
            'Application\DbConfigForm'   => 'Application\Form\DbConfigFormFactory',
            'Application\AdConfigForm'   => 'Application\Form\AdConfigFormFactory',
            'Application\MailServerForm' => 'Application\Form\MailServerFormFactory',
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
            
            // login
            array(
                'label' => 'Login',
                'route' => 'login',
                'visible' => 'false'
            ),
            
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
                        'label' => 'Delete Ticket',
                        'controller' => 'ticket',
                        'action' => 'delete',
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
                        'label' => 'Edit Company',
                        'controller' => 'company',
                        'action' => 'edit',
                    ),
                    array(
                        'label' => 'Delete Company',
                        'controller' => 'company',
                        'action' => 'delete',
                    ),
                    array(
                        'label' => 'Company Detail',
                        'controller' => 'company',
                        'action' => 'detail',
                    ),
                    array(
                        'label' => 'New Office',
                        'controller' => 'office',
                        'action' => 'add',
                    ),
                    array(
                        'label' => 'Edit Office',
                        'controller' => 'office',
                        'action' => 'edit',
                    ),
                    array(
                        'label' => 'Delete Office',
                        'controller' => 'office',
                        'action' => 'delete',
                    ),
                    array(
                        'label' => 'Office Detail',
                        'controller' => 'office',
                        'action' => 'detail',
                    ),
                    array(
                        'label' => 'New Department',
                        'controller' => 'department',
                        'action' => 'add',
                    ),
                    array(
                        'label' => 'Edit Department',
                        'controller' => 'department',
                        'action' => 'edit',
                    ),
                    array(
                        'label' => 'Delete Department',
                        'controller' => 'department',
                        'action' => 'delete',
                    ),
                    array(
                        'label' => 'Department Detail',
                        'controller' => 'department',
                        'action' => 'detail',
                    ),
                ),
            ),
            
            // Users
            array(
                'label' => '<i class="fa fa-user"></i> Users',
                'route' => 'cobalt/default',
                'controller' => 'user',
                'action' => 'index',
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
                        'label' => 'Add Hardware',
                        'controller' => 'user',
                        'action' => 'addhardware',
                    ),
                    array(
                        'label' => 'Remove Hardware',
                        'controller' => 'user',
                        'action' => 'removehardware',
                    ),
                    array(
                        'label' => 'Add Role',
                        'controller' => 'user',
                        'action' => 'addrole',
                    ),
                    array(
                        'label' => 'Remove Role',
                        'controller' => 'user',
                        'action' => 'removerole',
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
            
            // Computers
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
                    array(
                        'label' => 'Detail',
                        'controller' => 'computer',
                        'action' => 'detail',
                    ),
                ),
            ),
            
            // Printers
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
            
            // Hardware
            array(
                'label' => '<i class="fa fa-cubes"></i> Hardware',
                'route' => 'cobalt/default',
                'controller' => 'hardware',
                'pages' => array(
                    array(
                        'label' => 'Add',
                        'controller' => 'hardware',
                        'action' => 'add',
                    ),
                    array(
                        'label' => 'Edit',
                        'controller' => 'hardware',
                        'action' => 'edit',
                    ),
                    array(
                        'label' => 'Delete',
                        'controller' => 'hardware',
                        'action' => 'delete',
                    ),
                    array(
                        'label' => 'Hardware Detail',
                        'controller' => 'hardware',
                        'action' => 'detail',
                    ),
                    array(
                        'label' => 'Hardware Summary',
                        'controller' => 'hardware',
                        'action' => 'summary',
                    ),
                ),
            ),
            
            // Software
            array(
                'label' => '<i class="fa fa-floppy-o"></i> Software',
                'route' => 'cobalt/default',
                'controller' => 'software',
                'pages' => array(
                    array(
                        'label' => 'Add',
                        'controller' => 'software',
                        'action' => 'add',
                    ),
                    array(
                        'label' => 'Edit',
                        'controller' => 'software',
                        'action' => 'edit',
                    ),
                    array(
                        'label' => 'Delete',
                        'controller' => 'software',
                        'action' => 'delete',
                    ),
                    array(
                        'label' => 'Detail',
                        'controller' => 'software',
                        'action' => 'detail',
                    ),
                    array(
                        'label' => 'Software Summary',
                        'controller' => 'software',
                        'action' => 'summary',
                    ),
                    array(
                        'label' => 'Add Software License',
                        'controller' => 'softwarelicense',
                        'action' => 'add',
                    ),
                    array(
                        'label' => 'Edit Software License',
                        'controller' => 'softwarelicense',
                        'action' => 'edit',
                    ),
                    array(
                        'label' => 'Delete Software License',
                        'controller' => 'softwarelicense',
                        'action' => 'delete',
                    ),
                ),
            ),
            
            // Projects
            array(
                'label' => '<i class="fa fa-cubes"></i> Projects',
                'route' => 'project/default',
                'controller' => 'project',
                'pages' => array(
                    array(
                        'label' => 'Project Detail',
                        'controller' => 'project',
                        'action' => 'detail',
                        'pages' => array(
                            array(
                                'label' => 'Add milestone',
                                'controller' => 'milestone',
                                'action' => 'add'
                            ),
                            array(
                                'label' => 'Edit milestone',
                                'controller' => 'milestone',
                                'action' => 'edit'
                            ),
                            array(
                                'label' => 'Delete milestone',
                                'controller' => 'milestone',
                                'action' => 'delete'
                            ),
                            array(
                                'label' => 'Add task',
                                'controller' => 'project',
                                'action' => 'task'
                            ),
                            array(
                                'label' => 'Milestone Detail',
                                'controller' => 'milestone',
                                'action' => 'detail',
                                'pages' => array(
                                    array(
                                        'label' => 'Add Task',
                                        'controller' => 'task',
                                        'action' => 'add'
                                    ),
                                    array(
                                        'label' => 'Edit Task',
                                        'controller' => 'task',
                                        'action' => 'edit'
                                    ),
                                    array(
                                        'label' => 'Delete Task',
                                        'controller' => 'task',
                                        'action' => 'delete'
                                    ),
                                    array(
                                        'label' => 'Add comment',
                                        'controller' => 'milestone',
                                        'action' => 'comment'
                                    ),
                                    array(
                                        'label' => 'Task Detail',
                                        'controller' => 'task',
                                        'action' => 'detail',
                                    ),
                                ),
                            ),
                            array(
                                'label' => 'Add comment',
                                'controller' => 'project',
                                'action' => 'comment'
                            ),
                        ),   
                    ),
                    array(
                        'label' => 'Edit comment',
                        'controller' => 'comment',
                        'action' => 'edit'
                    ),
                    array(
                        'label' => 'Delete comment',
                        'controller' => 'comment',
                        'action' => 'delete'
                    ),
                ),
            ),
            
            // Domains
            array(
                'label' => '<i class="fa fa-cloud"></i> Domains',
                'route' => 'cobalt/default',
                'controller' => 'domain',
                'pages' => array(
                    array(
                        'label' => 'Add',
                        'controller' => 'domain',
                        'action' => 'add',
                    ),
                    array(
                        'label' => 'Edit',
                        'controller' => 'domain',
                        'action' => 'edit',
                    ),
                    array(
                        'label' => 'Delete',
                        'controller' => 'domain',
                        'action' => 'delete',
                    ),
                    array(
                        'label' => 'Detail',
                        'controller' => 'domain',
                        'action' => 'detail',
                    ),
                ),
            ),
            
            // FAQ
            array(
                'label' => '<i class="fa fa-comment"></i> FAQ',
                'route' => 'faq/default',
                'controller' => 'index',
                'action' => 'index',
                'pages' => array(
                    array(
                        'label' => 'New Question',
                        'controller' => 'index',
                        'action' => 'add',
                    ),
                    array(
                        'label' => 'Edit Question',
                        'controller' => 'index',
                        'action' => 'edit',
                    ),
                    array(
                        'label' => 'Delete Question',
                        'controller' => 'index',
                        'action' => 'delete',
                    ),
                ),
            ),
            
            // Admin
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
                        'controller' => 'hardware-type',
                        'action' => 'index',
                        'pages' => array(
                            array(
                                'label' => 'Add',
                                'controller' => 'hardware-type',
                                'action' => 'add',
                            ),
                            array(
                                'label' => 'Edit',
                                'controller' => 'hardware-type',
                                'action' => 'edit',
                            ),
                            array(
                                'label' => 'Delete',
                                'controller' => 'hardware-type',
                                'action' => 'delete',
                            ),
                            array(
                                'label' => 'Detail',
                                'controller' => 'hardware-type',
                                'action' => 'detail',
                            ),
                        ),
                    ),
                    
                    // Hardware statuses.
                    array(
                        'label' => 'Hardware Statuses',
                        'controller' => 'hardware-status',
                        'action' => 'index',
                        'pages' => array(
                            array(
                                'label' => 'Add',
                                'controller' => 'hardware-status',
                                'action' => 'add',
                            ),
                            array(
                                'label' => 'Edit',
                                'controller' => 'hardware-status',
                                'action' => 'edit',
                            ),
                            array(
                                'label' => 'Delete',
                                'controller' => 'hardware-status',
                                'action' => 'delete',
                            ),
                            array(
                                'label' => 'Detail',
                                'controller' => 'hardware-status',
                                'action' => 'detail',
                            ),
                        ),
                    ),
                
                    // Hardware manufacturers.
                    array(
                        'label' => 'Hardware Manufacturers',
                        'controller' => 'hardware-manufacturer',
                        'action' => 'index',
                        'pages' => array(
                            array(
                                'label' => 'Add',
                                'controller' => 'hardware-manufacturer',
                                'action' => 'add',
                            ),
                            array(
                                'label' => 'Edit',
                                'controller' => 'hardware-manufacturer',
                                'action' => 'edit',
                            ),
                            array(
                                'label' => 'Delete',
                                'controller' => 'hardware-manufacturer',
                                'action' => 'delete',
                            ),
                            array(
                                'label' => 'Detail',
                                'controller' => 'hardware-manufacturer',
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
                    
                    // Ticket priorities.
                    array(
                        'label' => 'Ticket Priorities',
                        'controller' => 'ticketpriority',
                        'action' => 'index',
                        'pages' => array(
                            array(
                                'label' => 'Add',
                                'controller' => 'ticketpriority',
                                'action' => 'add',
                            ),
                            array(
                                'label' => 'Edit',
                                'controller' => 'ticketpriority',
                                'action' => 'edit',
                            ),
                            array(
                                'label' => 'Delete',
                                'controller' => 'ticketpriority',
                                'action' => 'delete',
                            ),
                            array(
                                'label' => 'Detail',
                                'controller' => 'ticketpriority',
                                'action' => 'detail',
                            ),
                        ),
                    ),
                    
                    // Ticket impacts.
                    array(
                        'label' => 'Ticket Impacts',
                        'controller' => 'ticketimpact',
                        'action' => 'index',
                        'pages' => array(
                            array(
                                'label' => 'Add',
                                'controller' => 'ticketimpact',
                                'action' => 'add',
                            ),
                            array(
                                'label' => 'Edit',
                                'controller' => 'ticketimpact',
                                'action' => 'edit',
                            ),
                            array(
                                'label' => 'Delete',
                                'controller' => 'ticketimpact',
                                'action' => 'delete',
                            ),
                            array(
                                'label' => 'Detail',
                                'controller' => 'ticketimpact',
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
                    
                    // Database connection settings.
                    array(
                        'label' => 'Database connection settings',
                        'controller' => 'Index',
                        'action' => 'dbconfig',
                    ),
                    
                    // Active directory connection settings.
                    array(
                        'label' => 'Active Directory connection settings',
                        'controller' => 'Index',
                        'action' => 'adconfig',
                    ),
                    
                    // Incoming mail server settings.
                    array(
                        'label' => 'Incoming mail server',
                        'controller' => 'Index',
                        'action' => 'mailinconfig',
                    ),
                    
                    // Outgoing mail server settings.
                    array(
                        'label' => 'Outgoing mail server',
                        'controller' => 'Index',
                        'action' => 'mailoutconfig',
                    ),
                    
                    // Users update from ad.
                    array(
                        'label' => 'Update users from Active Directory.',
                        'controller' => 'User',
                        'action' => 'adupdate',
                    ),
                    
                    // Notification index.
                    array(
                        'label' => 'Notifications',
                        'route' => 'notification',
                        'controller' => 'Index',
                        'action' => 'index',
                        'pages' => array(
                            array(
                                'label' => 'Edit Notification Template',
                                'route' => 'template',
                                'controller' => 'Index',
                                'action' => 'template',
                            ),    
                        ),
                    ),

                ),
            ),
            // Help
            array(
                'label' => '<i class="fa fa-info-circle"></i> Help',
                'route' => 'help',
                'action' => 'help',
                'visible' => 'false'
            ),
        ),
    ),
    
);
