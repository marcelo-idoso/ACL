<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Base\Service;

use Doctrine\Common\Persistence\ObjectManager;

class ObjectService {
    
    protected $service;
    
    public function __construct(ObjectManager $objectManager) {
        
        ['factories' => array(
            $this->service => function ($sl) {
                $objectManager = $sl->get('Doctrine\ORM\EntityManager');

                    return new ObjectService($objectManager);
                }
            ),
        ];
            
    }
}
