<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class NavigationController extends AbstractActionController {
    
    public function menuAction() {
        return new ViewModel();
    }
    
}
