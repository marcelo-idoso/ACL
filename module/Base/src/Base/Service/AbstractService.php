<?php

namespace Base\Service;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator\ClassMethods;

abstract class AbstractService {
    
    protected $em;
    protected $entity;
    
    /**
     * 
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function save(Array $data = array()) {
        if (isset($data['id'])){
            $entity = $this->em->getReference($this->entity, $data['id']);
            
            $hydrator = new ClassMethods();
            $hydrator->hydrate($data, $entity);
        }else{
            $entity = new $this->entity($data);
        }
        
        $this->em->persist($entity);
        $this->em->flush();
        
        return $entity;
    }
}