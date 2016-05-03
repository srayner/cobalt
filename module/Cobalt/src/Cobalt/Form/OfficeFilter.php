<?php

namespace Cobalt\Form;

use Zend\InputFilter\InputFilter;

class OfficeFilter extends InputFilter
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
        
        // telephone
        $this->add(array(
            'name'       => 'phone',
            'required'   => false,
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'max' => 24,
                    ),
                ),
            ),
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
        
        // fax
        $this->add(array(
            'name'       => 'fax',
            'required'   => false,
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'max' => 24,
                    ),
                ),
            ),
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
    }
}
        