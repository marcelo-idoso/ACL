<?php
array(
'service_manager' => [
        'factories' => [
            // Configures the default SessionManager instance
            'Zend\Session\ManagerInterface' => 'Zend\Session\Service\SessionManagerFactory',
            // Provides session configuration to SessionManagerFactory
            'Zend\Session\Config\ConfigInterface' => 'Zend\Session\Service\SessionConfigFactory',
        ],
    ],
    'session_manager' => [
        // SessionManager config: validators, etc
    ],
    'session_config' => [
        // Set the session and cookie expiries to 15 minutes
        'cache_expire' => 900,
        'cookie_lifetime' => 900,
    ],);