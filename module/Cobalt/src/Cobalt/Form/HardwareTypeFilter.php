<?php

namespace Cobalt\Form;

use Zend\InputFilter\InputFilter;

class HardwareTypeFilter extends InputFilter
{
    public function __construct()
    {
        // name
        $this->add(array(
            'name'       => 'name',
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
        
        // description
        $this->add(array(
            'name'       => 'description',
            'required'   => false,
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
    }
}
        