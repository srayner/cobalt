<?php

namespace Project\Form;

use Zend\InputFilter\InputFilter;

class CommentFilter extends InputFilter
{
    public function __construct()
    {
        // comment
        $this->add(array(
            'name'       => 'comment',
            'required'   => true,
            'validators' => array(
                
            ),
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
    }
}