<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Base\Entity\AbstractEntity;

/**
 * Module
 *
 * @ORM\Table(name="module")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Module extends AbstractEntity {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="NOME", type="string", length=45, nullable=false)
     */
    private $nome;

    
    
    public function __construct(Array $options = array()){
        parent::__construct($options);
    }
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }


    function setId($idmodule) {
        $this->idmodule = $idmodule;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }



    public function exchangeArray() {
        return get_object_vars($this);
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
