<?php

namespace Base\Entity\Data\Field;

use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity
 * @ORM\HasLifecycleCallbacks
 */
trait Create {

    /**
     * Data de Criação de Registros
     * @var \DateTime 
     * 
     * @ORM\Column(name="date_create", type="datetime", nullable=false) 
     */
    protected $date_create = null;

    /**
     * 
     * @return \DateTime
     */
    public function getDateCreate() {
        return $this->date_create;
    }

    /**
     * 
     * @param \DateTime $data_create
     * @ORM\PrePersist
     * @return \Base\Entity\AbstractEntity
     */
    public function setDateCreate() {
        
        $this->date_create =   new \DateTime('now');
        
        return $this ;
    }
}
