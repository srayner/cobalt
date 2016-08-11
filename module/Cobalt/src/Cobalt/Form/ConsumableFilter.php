<?php

namespace Cobalt\Form;

use Zend\InputFilter\InputFilter;

class ConsumableFilter extends InputFilter
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
        
        // description
        $this->add(array(
            'name'       => 'description',
            'required'   => false,
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
        
        // qty in stock
        $this->add(array(
            'name'       => 'qtyInStock',
            'required'   => true,
            'validators' => array ( 
                array(
                    'name' => 'Digits', 'breakChainOnFailure' => true),    
                    array (
                        'name' => 'Between',
                        'options' => array (
                        'min' => 0,
                        'max' => 999999,
                        'messages' => array('notBetween' => 'Value must be between %min% and %max%')
                    )
                )
            )
        ));
        
        // reorder qty
        $this->add(array(
            'name'       => 'reorderQty',
            'required'   => true,
            'validators' => array ( 
                array(
                    'name' => 'Digits', 'breakChainOnFailure' => true),    
                    array (
                        'name' => 'Between',
                        'options' => array (
                        'min' => 0,
                        'max' => 999999,
                        'messages' => array('notBetween' => 'Value must be between %min% and %max%')
                    )
                )
            )
        ));
    }
}