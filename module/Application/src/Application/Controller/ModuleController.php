<?php

namespace Application\Controller;

use Base\Controller\AbstractController;

class ModuleController extends AbstractController {

    public function __construct() {
        $this->controller   = 'module';
        $this->route        = 'module';
        $this->entity       = 'Application\Entity\Module';
        $this->service      = 'Application\Service\ModuleService';
        $this->form         = 'Application\Form\ModuleForm';

    }

}