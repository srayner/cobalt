<?php
return array(
    
    // Modules to load in the application.
    'modules' => array(
        'CivUser',
        'CivAccess',
        'DoctrineModule',
        'DoctrineORMModule',
        'CivMail',
        'TwbBundle',
        'Application',
        'Cobalt',
        'FAQ',
        'Project',
        'Notification',
    ),

    'module_listener_options' => array(
        
        // Paths to look for modules.
        'module_paths' => array(
            './module',
            './vendor',
        ),

        // Paths from which to glob configuration files after modules are
        // loaded. These override configuration provided by modules themselves.
        'config_glob_paths' => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
    ),
);
