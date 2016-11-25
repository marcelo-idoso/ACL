<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application;

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/[page/:page]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                        'module'     => 'application',
                    ),
                ),
            ),
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        'controller'    => 'Index',
                        'action'        => 'index',
                        '__NAMESPACE__' => 'Application\Controller',
                        'module'     => 'application'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                        'child_routes' => array( //permite mandar dados pela url 
                            'wildcard' => array(
                                'type' => 'Wildcard'
                            ),
                        ),
                    ),
                ),
            ),
            'change' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/change',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Ticket',
                        'action'     => 'changestatus',
                        'module'     => 'change',
                    ),
                ),
            ),
            'create' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/create',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Ticket',
                        'action'     => 'create',
                        'module'     => 'application',
                    ),
                ),
            ),
            'read' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/read',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Ticket',
                        'action'     => 'read',
                        'module'     => 'application',
                    ),
                ),
            ),
            'site' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/site',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Site',
                        'action'     => 'site',
                        'module'     => 'application',
                    ),
                ),
            ),
            'menu' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/menu',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Navigation',
                        'action'     => 'menu',
                        'module'     => 'application',
                    ),
                ),
            ),
            'module' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/module',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Application\Controller\Module',
                        'action'     => 'index',
                        'module'     => 'module',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'inserir' => array(
                        'type' => 'Segment',
                            'options' => array(
                                'route'    => '/inserir',
                                
                            ),
                        )
                    ),
                )
         
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
           
             
        ),
        'aliases' => array(
            
        )
    ),
    'translator' => array(
        'locale' => 'pt_BR',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index'          => 'Application\Controller\IndexController',
            'Application\Controller\Ticket'         => 'Application\Controller\TicketController',
            'Application\Controller\Site'           => 'Application\Controller\SiteController',
            'Application\Controller\Navigation'     => 'Application\Controller\NavigationController',
            'Application\Controller\Module'         => 'Application\Controller\ModuleController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/403Permission'     => __DIR__ . '/../view/error/403.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    
    //Mapeamento de Entity Doctrine
    /* Fim configuração do doctrine */
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
    /* Fim configuração do doctrine */
);
