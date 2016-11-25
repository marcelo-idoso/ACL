<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Form;

use Zend\Form\Form;
use Application\Form\Filter\ModuleFilter;

class ModuleForm extends Form {

    public function __construct() {
         parent::__construct(NULL);
         
        $filter = new ModuleFilter();
        $this->setAttribute('method', 'POST');

        $this->setInputFilter($filter->getInputFilter());

        $nome = array(
            'name' => 'nome',
            'type' => 'Text',
            'options' => array(
                'label' => 'Nome:'
            ),
            'attributes' => array(
                'class' => 'form-control input-lg'
            )
        );

        $this->add($nome);
        $this->add(array(
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => array(
                'value' => 'Salvar',
                'id' => 'submitButton',
                'class' => 'btn btn-primary glyphicon glyphicon-heart'
            )
        ));
    }

}
