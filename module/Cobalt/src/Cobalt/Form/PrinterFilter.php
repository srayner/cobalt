<?php

namespace Cobalt\Form;

use Zend\InputFilter\InputFilter;

class PrinterFilter extends InputFilter
{
    public function __construct()
    {
        // technology
        $this->add(array(
            'name'       => 'reference',
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