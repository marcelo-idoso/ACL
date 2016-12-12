<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Base\EventManager;

use Traversable;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManagerAwareInterface;

class EventProvider implements EventManagerAwareInterface {

    /**
     *
     * @var EventManagerInterface 
     */
    protected $events;


    
    /**
     * 
     * @param EventManagerInterface $eventManager
     * @return \Base\EventManager\EventProvider
     */
    public function setEventManager(EventManagerInterface $eventManager) {
        $identifiers = [__CLASS__, get_called_class()];
        if (isset($this->eventIdentifier)) {
            if ((is_string($this->eventIdentifier)) || (is_array($this->eventIdentifier))
                || ($this->eventIdentifier instanceof Traversable)) {
                $identifiers = array_unique(array_merge($identifiers,
                    (array) $this->eventIdentifier));
            } elseif (is_object($this->eventIdentifier)) {
                $identifiers[] = $this->eventIdentifier;
            }
            // silently ignore invalid eventIdentifier types
        }
        $events->setIdentifiers($identifiers);
        $this->events = $events;
        return $this;
    }
    /**
     * Retrieve the event manager.
     *
     * Lazy-loads an EventManager instance if none registered.
     *
     * @return EventManagerInterface
     */
    public function getEventManager()
    {
        if (!$this->events instanceof EventManagerInterface) {
            $this->setEventManager(new EventManager());
        }
        return $this->events;
    }
}
