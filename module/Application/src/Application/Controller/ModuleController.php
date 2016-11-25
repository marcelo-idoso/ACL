<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Controller;

use Base\Controller\AbstractController;

class ModuleController extends  AbstractController{
    
    public function __construct() {
        $this->form         = 'Application\Form\ModuleForm';
        $this->controller   = 'module';
        $this->route        = 'module/default';
        $this->service      = 'Application\Service\ModuleService';
        $this->entity       = 'Application\Entity\Module';
        
      
    }
    
}
