<?php

/**
 * File: bjyauthorize.global.php
 */
return array(
    'bjyauthorize' => array(
        'default_role' => 'guest',
        // Template Error 403
        'template' => 'error/403Permission',
        
        'identity_provider' => 'BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider',
        'authenticated_role' => 'user',
        'role_providers' => array(
            'BjyAuthorize\Provider\Role\ObjectRepositoryProvider' => array(
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'role_entity_class' => 'Application\Entity\Role',
            ),
            'BjyAuthorize\Provider\Role\Config' => array(
                'guest' => array(),
            )
        ),
        'resource_providers' => array(
            'BjyAuthorize\Provider\Resource\Config' => array(
                'Ticket' => array(),
                'Home' => array('authenticated')
            ),
        ),
        'rule_providers' => array(
            'BjyAuthorize\Provider\Rule\Config' => array(
                'allow' => array(
                    array('authenticated', 'Home', 'see'),
                    array('user', 'Ticket', 'create'),
                    array('agent', 'Ticket', array('change_status', 'read')),
                )
            ),
        ),
        'guards' => array(
            'BjyAuthorize\Guard\Controller' => array(
                // Acesso para Todas as Actions
                array(
                    'controller' => 'zfcuser',
                    'roles' => array('guest', 'authenticated')),
                array(
                    'controller' => 'Application\Controller\Index',
                    'roles' => array('authenticated', 'user')),
                array(
                    'controller' => 'Application\Controller\Ticket',
                    'roles' => array('agent')
                ),
                array(
                    'controller' => 'Application\Controller\Navigation',
                    'roles' => array('authenticated')
                ),
                array(
                    'controller' => 'Application\Controller\Module',
                    'roles' => array('authenticated')
                ),
            ),
        ),
        'zenddevelopertools' => array(
            'profiler' => array(
                'collectors' => array(
                    'bjy_authorize_role_collector' => 'BjyAuthorize\\Collector\\RoleCollector',
                ),
            ),
            'toolbar' => array(
                'entries' => array(
                    'bjy_authorize_role_collector' => 'zend-developer-tools/toolbar/bjy-authorize-role',
                ),
            ),
        ),
        
       
    ),
);
