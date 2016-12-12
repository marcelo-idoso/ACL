<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Base\Entity;


use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * @Entity
 * @ORM\HasLifecycleCallbacks
 */
abstract class AbstractEntity {
    
    use \Base\Entity\Data\Field\Create;
    use \Base\Entity\Data\Field\Update;
    
    
    /**
     * 
     * @param array $options
     */
    public function __construct(Array $options = array()) {
        $hydrator = new ClassMethods;
        $hydrator->hydrate($options, $this);
    }
    
    /**
     * 
     * @return type
     */
    public function toArray() {
        $hydrator = new ClassMethods;
        return $hydrator->extract($this);
    }
    
     /**
     * 
     * @return type
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
    
    public function exchangeArray() {
        return get_object_vars($this);
    }
}
