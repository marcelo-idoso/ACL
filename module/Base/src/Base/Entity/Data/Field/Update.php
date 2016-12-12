<?php

namespace Base\Entity\Data\Field;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
trait Update {

    /**
     * @var \DateTime
     * 
     * @ORM\Column( name="date_update", type="datetime", nullable=false , columnDefinition="datetime on update CURRENT_TIMESTAMP")
     */
    protected $date_update = null;

    /**
     * 
     * @return \DateTime
     */
    public function getDateUpdate() {
        return $this->date_update;
    }

    /**
     * 
     * @param type $date_update
     * @ORM\PreUpdate
     * @return \Base\Entity\AbstractEntity
     */
    public function setDateUpdate() {

        $this->date_update = new \DateTime('now');

        return $this;
    }

}
