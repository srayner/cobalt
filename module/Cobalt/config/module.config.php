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
        'abstract_factories' => array(
            'Cobalt\Controller\AbstractControllerFactory'
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
            'Cobalt\Company'              => 'Cobalt\Entity\Company',
            'Cobalt\Computer'             => 'Cobalt\Entity\Computer',
            'Cobalt\Department'           => 'Cobalt\Entity\Department',
            'Cobalt\Domain'               => 'Cobalt\Entity\Domain',
            'Cobalt\DomainStatus'         => 'Cobalt\Entity\DomainStatus',
            'Cobalt\Hardware'             => 'Cobalt\Entity\Hardware',
            'Cobalt\HardwareManufacturer' => 'Cobalt\Entity\HardwareManufacturer',
            'Cobalt\HardwareStatus'       => 'Cobalt\Entity\HardwareStatus',
            'Cobalt\HardwareType'         => 'Cobalt\Entity\HardwareType',
            'Cobalt\Office'               => 'Cobalt\Entity\Office',
            'Cobalt\Printer'              => 'Cobalt\Entity\Printer',
            'Cobalt\Software'             => 'Cobalt\Entity\Software',
            'Cobalt\SoftwareCategory'     => 'Cobalt\Entity\SoftwareCategory',
            'Cobalt\SoftwareInstallation' => 'Cobalt\Entity\SoftwareInstallation',
            'Cobalt\SoftwareLicense'      => 'Cobalt\Entity\SoftwareLicense',
            'Cobalt\SoftwareManufacturer' => 'Cobalt\Entity\SoftwareManufacturer',
            'Cobalt\SoftwareType'         => 'Cobalt\Entity\SoftwareType',
            'Cobalt\TicketCategory'       => 'Cobalt\Entity\TicketCategory',
            'Cobalt\TicketImpact'         => 'Cobalt\Entity\TicketImpact',
            'Cobalt\TicketPriority'       => 'Cobalt\Entity\TicketPriority',
            'Cobalt\TicketStatus'         => 'Cobalt\Entity\TicketStatus',
            'Cobalt\TicketType'           => 'Cobalt\Entity\TicketType',
            'Cobalt\User'                 => 'Cobalt\Entity\User',
            'WhoIsService'                => 'Cobalt\Service\WhoIsService',
        ),
        'factories' => array(
            
            // Services
            'Cobalt\ActiveDirectoryService'   => 'Cobalt\Service\ActiveDirectoryServiceFactory',
            'Cobalt\WMIService'               => 'Cobalt\Service\WMIServiceFactory',
            'Cobalt\HistoryService'           => 'Cobalt\Service\HistoryServiceFactory',
         
            // Forms
            'Cobalt\DepartmentForm'           => 'Cobalt\Form\DepartmentFormFactory',
            'Cobalt\DomainForm'               => 'Cobalt\Form\DomainFormFactory',
            'Cobalt\UserForm'                 => 'Cobalt\Form\UserFormFactory',
            'Cobalt\CompanyForm'              => 'Cobalt\Form\CompanyFormFactory',
            'Cobalt\OfficeForm'               => 'Cobalt\Form\OfficeFormFactory',
            'Cobalt\ComputerForm'             => 'Cobalt\Form\ComputerFormFactory',
            'Cobalt\HardwareForm'             => 'Cobalt\Form\HardwareFormFactory',
            'Cobalt\HardwareManufacturerForm' => 'Cobalt\Form\HardwareManufacturerFormFactory',
            'Cobalt\HardwareTypeForm'         => 'Cobalt\Form\HardwareTypeFormFactory',
            'Cobalt\HardwareStatusForm'       => 'Cobalt\Form\HardwareStatusFormFactory',
            'Cobalt\HostnameForm'             => 'Cobalt\Form\HostnameFormFactory',
            'Cobalt\PrinterForm'              => 'Cobalt\Form\PrinterFormFactory',
            'Cobalt\SoftwareForm'             => 'Cobalt\Form\SoftwareFormFactory',
            'Cobalt\SoftwareCategoryForm'     => 'Cobalt\Form\SoftwareCategoryFormFactory',
            'Cobalt\SoftwareLicenseForm'      => 'Cobalt\Form\SoftwareLicenseFormFactory',
            'Cobalt\SoftwareManufacturerForm' => 'Cobalt\Form\SoftwareManufacturerFormFactory',
            'Cobalt\SoftwareTypeForm'         => 'Cobalt\Form\SoftwareTypeFormFactory',
            'Cobalt\TicketTypeForm'           => 'Cobalt\Form\SimpleEntityFormFactory',
            'Cobalt\TicketStatusForm'         => 'Cobalt\Form\SimpleEntityFormFactory',
            'Cobalt\TicketPriorityForm'       => 'Cobalt\Form\SimpleEntityFormFactory',
            'Cobalt\TicketImpactForm'         => 'Cobalt\Form\SimpleEntityFormFactory',
            'Cobalt\TicketCategoryForm'       => 'Cobalt\Form\SimpleEntityFormFactory',
            
        ),
        'abstract_factories' => array(
            'Cobalt\Service\EntityServiceFactory'
        ),
    ),
    
    // Cobalt
    'cobalt' => array (
        'computer_model_class'  => 'Cobalt\Model\Computer\Computer',
        'logical_disk_model_class'  => 'Cobalt\Model\LogicalDisk\LogicalDisk',
    )  
);
