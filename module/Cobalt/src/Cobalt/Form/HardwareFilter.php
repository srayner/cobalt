<?php

namespace Cobalt\Form;

use Zend\InputFilter\InputFilter;

class HardwareFilter extends InputFilter
{
    public function __construct()
    {
        // reference
        $this->add(array(
            'name'       => 'reference',
            'required'   => false,
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'max' => 16,
                    ),
                ),
            ),
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
        
        // asset number
        $this->add(array(
            'name'       => 'assetNumber',
            'required'   => false,
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'max' => 32,
                    ),
                ),
            ),
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
        
        
    }
}
        