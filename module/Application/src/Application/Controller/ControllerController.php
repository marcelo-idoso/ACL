<?php

namespace Application\Controller;

use Base\Controller\AbstractController;

class ControllerController extends AbstractController {

    public function __construct() {
        $this->controller   = 'controller';
        $this->route        = 'controller';
        $this->entity       = 'Application\Entity\Controller';
        $this->service      = 'Application\Service\ControllerService';
        $this->form         = 'Application\Form\Controller';

    }
    
    public function inserirAction() {
        $this->form = $this->getServiceLocator()->get($this->form);
        
        return parent::inserirAction();
    }
    
    public function editarAction() {
        $this->form = $this->getServiceLocator()->get($this->form);
        
        return parent::editarAction();
    }

}