<?php

namespace Cobalt\Form;

use Zend\InputFilter\InputFilter;

abstract class AbstractFilter extends InputFilter
{
    protected function addTextFilter($name, $reqd, $size)
    {
        $this->add(array(
            'name'       => $name,
            'required'   => $reqd,
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'max' => $size,
                    ),
                ),
            ),
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
        return $this;
    }
}
