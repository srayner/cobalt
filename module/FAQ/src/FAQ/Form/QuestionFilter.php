<?php

namespace FAQ\Form;

use Zend\InputFilter\InputFilter;

class QuestionFilter extends InputFilter
{
    public function __construct()
    {
        // question
        $this->add(array(
            'name'       => 'question',
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
        
        // answer
        $this->add(array(
            'name'       => 'answer',
            'required'   => false,
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
    }
}
        