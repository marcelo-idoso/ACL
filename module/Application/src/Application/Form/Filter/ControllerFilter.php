<?php

namespace Application\Form\Filter;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterAwareInterface;


class ControllerFilter implements InputFilterAwareInterface{
    
    protected $filter ;
    
    public function getInputFilter(Array $module = array()) {
        if(!$this->filter){
            $inputFilter = new InputFilter();
            
            //Filter Nome
            $inputFilter->add(array(
                'name'      => 'ds_controller' ,
                'requerid'  => TRUE,
                'filters'   => array(
                    array('name'   => 'StripTags'),
                    array('name'   => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'      => 'StringLength',
                        'options'   => array(
                            'encoding' => 'UTF-8',
                            'min'      => '1',
                            'max'      => '50',
                        )
                    )
                )
            ));
                      
            $this->filter = $inputFilter ;
        }
        
        return $this->filter ;
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception('Não Usado');
    }
    
    /**
     * 
     * @param array $haystack
     * @return Array
     */
    public function haystack(Array $haystack = array()) {
        $array = array();
        foreach ($haystack as $value) {
            $array[$value['value']] = $value['label'];
        }
        return array_keys($array);
    }
}
