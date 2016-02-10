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
                'cobalt_logical_disk_mapper' => function($sm) {
                    $mapper = new Model\LogicalDisk\LogicalDiskMapper;
                    $prototypeClass = Module::getOption('logical_disk_model_class');
                    $mapper->setEntityPrototype(new $prototypeClass);
                    $mapper->setHydrator(new \Zend\Stdlib\Hydrator\ClassMethods);
                    return $mapper;
                },
                'civwmi_logical_disk' => function($sm) {
                    return new Model\LogicalDisk\LogicalDisk;
                },
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
