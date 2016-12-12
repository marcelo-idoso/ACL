<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Application\Service\ModuleService;
use Application\Service\ControllerService;
use Application\Form\Controller;

class Module
{
    public function onBootstrap($e)
    {
        $e->getApplication()->getServiceManager()->get('translator'); 
        
        
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
      
        $sm = $e->getApplication()->getServiceManager();
        // Add ACL information to the Navigation view helper
        $authorize = $sm->get('BjyAuthorizeServiceAuthorize');
        $acl = $authorize->getAcl();
        $role = $authorize->getIdentity();
        \Zend\View\Helper\Navigation::setDefaultAcl($acl);
        \Zend\View\Helper\Navigation::setDefaultRole($role);
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
    
    public function getServiceConfig() {
        return array(
            'factories' => array(
                'Application\Service\ModuleService' => function ($em){
                    return new ModuleService($em->get('Doctrine\ORM\EntityManager'));
                    },
                'Application\Service\ControllerService' => function ($e){
                    return new ControllerService($e->get('Doctrine\ORM\EntityManager'));
                    },
                'Application\Form\Controller' => function ($e){
                    return new Controller($e->get('Doctrine\ORM\EntityManager'));
                    }, 
                )        
        );
  
    }
    
}
