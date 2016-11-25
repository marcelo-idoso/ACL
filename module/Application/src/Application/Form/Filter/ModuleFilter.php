<?php


namespace Application\Form\Filter;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class ModuleFilter implements InputFilterAwareInterface {
    
    protected $inputFilter;


    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            
            // Filter Nome
            $inputFilter->add(
                    array(
                        'name'      => 'nome',
                        'requerid'  => TRUE,
                        'filters'   => array(
                            array( 'name'  => 'StripTags'),
                            array( 'name'  => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name'    => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min'      => '1',
                                    'max'      => '50',
                                ) 
                            )
                        )
                    )
                );
            $this->inputFilter = $inputFilter;
        }
        
        return $this->inputFilter;
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception('Não Usado');
    }

}
