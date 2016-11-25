<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Base\Entity\AbstractEntity;
/**
 * Module
 *
 * @ORM\Table(name="module")
 * @ORM\Entity
 */
class Module extends AbstractEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idModule", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmodule;

    /**
     * @var string
     *
     * @ORM\Column(name="NOME", type="string", length=45, nullable=false)
     */
    private $nome;
    
    function getIdmodule() {
        return $this->idmodule;
    }
    function getNome() {
        return $this->nome;
    }
    function setIdmodule($idmodule) {
        $this->idmodule = $idmodule;
    }
    function setNome($nome) {
        $this->nome = $nome;
    }


}
