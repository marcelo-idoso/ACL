<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Base\Entity\AbstractEntity;
/**
 * Controller
 *
 * @ORM\Table(name="controller", indexes={@ORM\Index(name="IDX_4CF2669A68998B84", columns={"idmodule"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * 
 */
class Controller extends AbstractEntity {

    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ds_controller", type="string", length=45, nullable=false)
     */
    private $ds_controller;

    /**
     * @var \Application\Entity\Module
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Module")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idmodule", referencedColumnName="id" , nullable=false)
     * })
     */
    private $idmodule;

    public function __construct(array $options = array()) {
        parent::__construct($options);
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set dsController
     *
     * @param string $dsController
     * @return Controller
     */
    public function setDsController($dsController) {
        $this->ds_controller = $dsController;

        return $this;
    }

    /**
     * Get dsController
     *
     * @return string 
     */
    public function getDsController() {
        return $this->ds_controller;
    }

    /**
     * Set idmodule
     *
     * @param \Application\Entity\Module $idmodule
     * @return Controller
     */
    public function setIdmodule(\Application\Entity\Module $idmodule = null) {
        $this->idmodule = $idmodule;

        return $this;
    }

    /**
     * Get idmodule
     *
     * @return \Application\Entity\Module 
     */
    public function getIdmodule() {
        return $this->idmodule;
    }

    public function exchangeArray() {
        return get_object_vars($this);
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
