<?php

namespace Cobalt\Form;

use Zend\InputFilter\InputFilter;

class SoftwareLicenseFilter extends InputFilter
{
    public function __construct()
    {
        // license key
        $this->add(array(
            'name'       => 'licenseKey',
            'required'   => false,
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'max' => 128,
                    ),
                ),
            ),
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
        
        // instllations allowed
        $this->add(array(
            'name'       => 'installationsAllowed',
            'required'   => true,
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
    }
}