<?php

namespace Application\Form;

use Zend\Form\Form;
use Application\Form\Filter\ControllerFilter;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;

class Controller extends Form implements ObjectManagerAwareInterface {

    protected $objectManager;

    public function __construct(ObjectManager $objectManager) {

        $this->setObjectManager($objectManager);

        parent::__construct(NULL);
        $filter = new ControllerFilter();
        $this->setAttribute('method', 'POST');



        $nome = array(
            'name' => 'ds_controller',
            'type' => 'Text',
            'options' => array(
                'label' => "Nome: "
            ),
            'attributes' => array(
                'class' => 'form-control input-lg'
            ),
        );
        /* @var $module \DoctrineModule\Form\Element\ObjectSelect */
        $module = array(
            'name' => 'idmodule',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'object_manager' => $this->getObjectManager(),
                'target_class' => 'Application\Entity\Module',
                'property' => 'nome',
                'label' => 'Modelo: ',
                'empty_option' => '--- Selecionar Module ---',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(),
                        'orderBy' => array('nome' => 'ASC'),
                    ),
                ),
            ),
            'attributes' => array(
                'class' => 'form-control input-lg'
            ),
        );
        $this->add($nome);
        $this->add($module);
        $this->add(array(
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => array(
                'value' => 'Salvar',
                'id' => 'submitButton',
                'class' => 'btn btn-primary glyphicon glyphicon-heart'
            )
        ));

        $this->setInputFilter($filter->getInputFilter());
    }

    /**
     * 
     * @return ObjectManager
     */
    public function getObjectManager() {
        return $this->objectManager;
    }

    /**
     * 
     * @param ObjectManager $objectManager
     */
    public function setObjectManager(ObjectManager $objectManager) {
        $this->objectManager = $objectManager;
    }

}
