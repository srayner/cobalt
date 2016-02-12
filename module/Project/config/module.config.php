<?php

namespace Project;

use Zend\Mvc\Controller\ControllerManager;

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
        'factories' => array(
            'Project\Controller\Project' => function(ControllerManager $cm) {
                $sm = $cm->getServiceLocator();
                $service = $sm->get('Project\ProjectService');
                return new Controller\ProjectController($service);
            },
            'Project\Controller\Milestone' => function(ControllerManager $cm) {
                $sm = $cm->getServiceLocator();
                $service = $sm->get('Project\MilestoneService');
                return new Controller\MilestoneController($service);
            },
            'Project\Controller\Task' => function(ControllerManager $cm) {
                $sm = $cm->getServiceLocator();
                $service = $sm->get('Project\TaskService');
                return new Controller\TaskController($service);
            },
            'Project\Controller\Comment' => function(ControllerManager $cm) {
                $sm = $cm->getServiceLocator();
                $service = $sm->get('Project\CommentService');
                return new Controller\CommentController($service);
            },
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
            'project'         => 'Project\Entity\Project',
            'milestone'       => 'Project\Entity\Milestone',
            'task'            => 'Project\Entity\Task',
            'Project\Comment' => 'Project\Entity\Comment',
        ),
        'factories' => array(
            'project_form'             => 'Project\Form\ProjectFormFactory',
            'Project\ProjectService'   => 'Project\Service\ProjectServiceFactory',
            'Project\MilestoneService' => 'Project\Service\MilestoneServiceFactory',
            'Project\MilestoneForm'    => 'Project\Form\MilestoneFormFactory',
            'Project\TaskService'      => 'Project\Service\TaskServiceFactory',
            'Project\TaskForm'         => 'Project\Form\TaskFormFactory',
            'Project\CommentService'   => 'Project\Service\CommentServiceFactory',
            'Project\CommentForm'      => 'Project\Form\CommentFormFactory',
        ),
    ),
        
);