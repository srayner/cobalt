<?php

namespace Project;

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
            
            'project' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/planning',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Project\Controller',
                        'controller'    => 'Project',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/:controller[/:action[/:id]]',
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
            'Project\Controller\Project'   => 'Project\Controller\ProjectController',
            'Project\Controller\Milestone' => 'Project\Controller\MilestoneController',
            'Project\Controller\Task'      => 'Project\Controller\TaskController'
        ),
    ),
    
    // View manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    
    //Service manager config.
    'service_manager' => array (
        'invokables' => array(
            'project' => 'Project\Entity\Project',
        ),
        'factories' => array(
            'project_form' => 'Project\Form\ProjectFormFactory',
        ),
    ),
        
);