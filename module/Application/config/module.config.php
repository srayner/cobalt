<?php

return array(
    
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
        'factories' => array(
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
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
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
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
            array(
                'label' => '<i class="fa fa-area-chart"></i> Dashboard',
                'route' => 'cobalt',
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
                'label' => '<i class="fa fa-cubes"></i> Projects',
                'route' => 'project/default',
                'controller' => 'project',
            ),
        ),
    ),
    
);
