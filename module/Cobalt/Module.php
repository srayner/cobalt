<?php

namespace Cobalt;

use Zend\ModuleManager\ModuleManager;

class Module
{
    protected static $options;
    
    public function init(ModuleManager $moduleManager)
    {
        $moduleManager->getEventManager()->attach('loadModules.post', array($this, 'modulesLoaded'));
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig()
    {
        return array(
            'invokables' => array(
                'cobalt_form_hydrator' => 'Zend\Stdlib\Hydrator\ClassMethods'
            ),
            'factories' => array(
                'cobalt_active_directory_service' => function($sm) {
                    $service = new Service\ActiveDirectory;
                    $options = $sm->get('cobalt')['ldap'];
                    $service->setOptions($options);
                    return $service;
                },
                'cobalt_user_service' => function($sm) {
                    $service = new Service\User;
                    $service->setUserMapper($sm->get('cobalt_user_mapper'));
                    return $service;
                },
                'cobalt_user_mapper' => function($sm) {
                    $mapper = new Model\User\UserMapper;
                    $mapper->setEntityPrototype(new Model\User\User());
                    $mapper->setHydrator(new Model\User\UserHydrator());
                    return $mapper;
                },
                'cobalt_activity_service' => function($sm) {
                    $service = new Service\Activity;
                    $path = $sm->get('cobalt')['activity_log_path'];
                    $service->setLogPath($path);
                    $service->setActivityMapper($sm->get('cobalt_activity_mapper'));
                    return $service;
                },
                'cobalt_activity_mapper' => function($sm) {
                    $mapper = new Model\Activity\ActivityMapper;
                    $mapper->setEntityPrototype(new Model\Activity\Activity());
                    $mapper->setHydrator(new Model\Activity\ActivityHydrator());
                    return $mapper;
                },
                'cobalt_computer_service' => function($sm) {
                    $service = new Service\Computer;
                    $service->setComputerMapper($sm->get('cobalt_computer_mapper'));
                    $service->setLogicalDiskMapper($sm->get('cobalt_logical_disk_mapper'));
                    return $service;
                },
                'cobalt_computer_mapper' => function($sm) {
                    $mapper = new Model\Computer\ComputerMapper;
                    $computerModelClass = Module::getOption('computer_model_class');
                    $mapper->setEntityPrototype(new $computerModelClass);
                    $mapper->setHydrator(new \Zend\Stdlib\Hydrator\ClassMethods);
                    return $mapper;
                },
                'cobalt_computer_form' => function ($sm) {
                    $form = new Form\ComputerForm();
                    $form->setInputFilter(new Form\ComputerFilter());
                    return $form;
                },
                'cobalt_logical_disk_mapper' => function($sm) {
                    $mapper = new Model\LogicalDisk\LogicalDiskMapper;
                    $prototypeClass = Module::getOption('logical_disk_model_class');
                    $mapper->setEntityPrototype(new $prototypeClass);
                    $mapper->setHydrator(new \Zend\Stdlib\Hydrator\ClassMethods);
                    return $mapper;
                },
                'cobalt_computer' => function($sm) {
                    return new Model\Computer\Computer;
                },
                'civwmi_logical_disk' => function($sm) {
                    return new Model\LogicalDisk\LogicalDisk;
                },
                'cobalt_computer_form' => function($sm) {
                    return new Form\ComputerForm();
                }
            ),
            'initializers' => array(
                function($instance, $sm){
                    if($instance instanceof Service\DbAdapterAwareInterface){
                        $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                        return $instance->setDbAdapter($dbAdapter);
                    }
                },
            ),
        );
                        
    }
    
    public function modulesLoaded($e)
    {
        $config = $e->getConfigListener()->getMergedConfig();
        static::$options = $config['cobalt'];
    }
    
    public static function getOption($option)
    {
        if (!isset(static::$options[$option])) {
            return null;
        }
        
        return static::$options[$option];
    }
}
