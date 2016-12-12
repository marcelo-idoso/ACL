<?php


namespace Base\Service\ORM;

use Base\EventManager\EventProvider;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorAwareInterface;


abstract class AbstractEntityLos extends EventProvider implements ServiceLocatorAwareInterface{
    
    use ServiceLocatorAwareTrait;
    protected $entity;
   

    public function save(Array $data = array()) {
        
        $this->getEventManager()->trigger(__FUNCTION__.'.init', $this ,[
            'entity' => $this->entity
        ]);
        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $entity = new $this->entity($data);
        $em->persist($entity);
        $em->flush();
        
        return $entity;
    }
    
}
