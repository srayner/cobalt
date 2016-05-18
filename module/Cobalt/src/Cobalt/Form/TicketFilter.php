<?php

namespace Cobalt\Form;

use Zend\InputFilter\InputFilter;

class TicketFilter extends InputFilter
{
    public function __construct()
    {
        // subject
        $this->add(array(
            'name'       => 'subject',
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