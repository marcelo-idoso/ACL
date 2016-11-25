<?php

/**
 * File: TicketController.php
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use BjyAuthorize\Exception\UnAuthorizedException;

/**
 * Class TicketController
 * @package Application\Controller
 */
class TicketController extends AbstractActionController
{
    /**
     * Only users with the role "user" can create tickets.
     */
    public function createAction()
    {
        if(!$this->isAllowed('Ticket' , 'create')){
            throw new UnAuthorizedException();
        }
        echo "Creating a ticket.";
        return false;
    }

    /**
     * Only users with the role "agent" can change a ticket status.
     */
    public function changeStatusAction()
    {
        if (!$this->isAllowed('Ticket', 'change_status')) {
            throw new UnAuthorizedException();
        }
        echo "Changing a ticket's status.";
        return false;
    }

    /**
     * Only users with the role "agent" can read tickets.
     */
    public function readAction()
    {
         if (!$this->isAllowed('Ticket', 'read')) {
            throw new UnAuthorizedException();
        }
        echo "Reading a ticket.";
        return false;
    }
}