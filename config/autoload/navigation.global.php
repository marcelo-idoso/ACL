<?php

return array(
    'navigation' => array(
        'default'=> array(
            array(
                'label'    => 'Home',
                'route'    => 'application',
                'icon'  => 'fa fa-dashboard',
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
                                'label'    => 'Module Inserir',
                                'route'    => 'module/inserir',
                                'resource' => 'controller/Application\Controller\Module' ,
                            ),
                            array(
                                'label'    => 'Module Editar',
                                'route'    => 'module/editar',
                                'resource' => 'controller/Application\Controller\Module' ,
                            )
                        )
                    ), 
                    array(
                        'label'    => 'Controller',
                        'route'    => 'controller',
                        'resource' => 'controller/Application\Controller\Controller' ,
                        'pages'    => array(
                            array(
                                'label'    => 'Controller Inserir',
                                'route'    => 'controller/inserir',
                                'resource' => 'controller/Application\Controller\Controller' ,
                            ),
                            array(
                                'label'    => 'Controller Editar',
                                'route'    => 'controller/editar',
                                'resource' => 'controller/Application\Controller\Controller' ,
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
