<?php

namespace Cobalt\Form;

use Zend\InputFilter\InputFilter;

class HostnameFilter extends InputFilter
{
    public function __construct()
    {
        // Hostname
        $this->add(array(
            'name'       => 'hostname',
            'required'   => true,
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
    }
}
        