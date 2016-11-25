<?php

return array(
    'navigation' => array(
        'default'=> array(
            array(
                'label'    => 'Home',
                'route'    => 'application',
                'resource' => 'controller/Application\Controller\Index',
                'pages'    => array(
                    array(
                        'label' => 'Ticket Create',
                        'route' => 'create',
                        'resource' => 'controller/Application\Controller\Ticket'
                    ),
                    array(
                        'label'    => 'Module',
                        'route'    => 'module',
                        'resource' => 'controller/Application\Controller\Module' ,
                        'pages'    => array(
                            array(
                                'label'    => 'Module',
                                'route'    => 'module/inserir',
                                'resource' => 'controller/Application\Controller\Module' ,
                            )
                        )
                    )
                ) 
            ),
        ),
    ),
    
    'service_manager' => array(
         'factories' => array(
             'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
         ),
     ),
);
