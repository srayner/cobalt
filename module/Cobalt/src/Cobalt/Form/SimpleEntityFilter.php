<?php

namespace Cobalt\Form;

use Zend\InputFilter\InputFilter;

class SimpleEntityFilter extends InputFilter
{
    public function __construct()
    {
        // Name
        $this->add(array(
            'name'       => 'hostname',
            'required'   => true,
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'max' => 64,
                    ),
                ),
            ),
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
        
        // Description
        $this->add(array(
            'name'       => 'description',
            'required'   => false,
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));   
    }
}