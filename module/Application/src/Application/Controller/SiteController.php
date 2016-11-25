<?php

/**
 * File: TicketController.php
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class SiteController extends AbstractActionController {

    /**
     * Only users with the role "user" can create tickets.
     */
    public function siteAction() {
        
        echo "Site";
        return false;
    }

}
