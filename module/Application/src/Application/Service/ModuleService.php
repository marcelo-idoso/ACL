<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Service;

use Base\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class ModuleService extends AbstractService {
    
    public function __construct(EntityManager $em) {
        $this->entity = '\Application\Entity\Module';
        parent::__construct($em);
        
    }
}
