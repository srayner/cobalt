<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    
    'civuser' => array(
        'profile_link' => array(
            'class' => 'btn btn-default'
        ),
        'persistance' => array(
            'type' => 'dbtable',
            'table' => 'user'
        ),
        'adapter' => array(
            'type'             => 'dbtable',
            'table'            => 'user',
            'identifier_field' => 'username',
            'credential_field' => 'password'
        ),
    ),
    
    'CivAccess' => array(
        'new_role_event_id'     => 'Cobalt\Service\UserService',
        'new_role_event'        => 'add.post',
        'new_role_event_param'  => 'user',
        'old_role_event_id'     => 'Cobalt\Service\UserService',
        'old_role_event'        => 'remove.post',
        'old_role_event_param'  => 'id',
        'display_info'          => true
    ),
    
    'service_manager' => array(
        'aliases' => array(
            'CivAccess\AuthService' => 'CivUser\AuthService'
        ),
    ),
);
