<?php

namespace Cobalt\Form;

use Zend\InputFilter\InputFilter;

class HardwareManufacturerFilter extends InputFilter
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
        
        // address
        $this->add(array(
            'name'       => 'address',
            'required'   => false,
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
        
        // email
        $this->add(array(
            'name'       => 'email',
            'required'   => false,
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'max' => 256,
                    ),
                ),
            ),
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
        
        // website Url
        $this->add(array(
            'name'       => 'websiteUrl',
            'required'   => false,
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'max' => 256,
                    ),
                ),
            ),
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
    }
}
        