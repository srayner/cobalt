<?php

namespace Cobalt\Form;

use Zend\InputFilter\InputFilter;

class DomainFilter extends InputFilter
{
    public function __construct()
    {
        // Domain Name
        $this->add(array(
            'name'       => 'name',
            'required'   => true,
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
