<?php

namespace Cobalt\Form;

use Zend\Form\Form;

class UserForm extends Form
{
    public function __construct()
    {
        parent::__construct();
        
        $this->setAttribute('class', 'zend-form');
        
        $this->add(array(
                'name' => 'username',
                'options' => array(
                        'label' => 'Username',
                ),
                'attributes' => array(
                        'type' => 'text',
                        'class' => 'form-control input-sm'
                ), 
        ));
        
        $this->add(array(
                'name' => 'office',
                'options' => array(
                        'label' => 'Office',
                ),
                'attributes' => array(
                        'type' => 'text',
                        'class' => 'form-control input-sm'
                ), 
        ));
        
        $this->add(array(
                'name' => 'telephone_number',
                'options' => array(
                        'label' => 'Telephone No',
                ),
                'attributes' => array(
                        'type' => 'text',
                        'class' => 'form-control input-sm'
                ), 
        ));
        
        $this->add(array(
                'name' => 'extension_number',
                'options' => array(
                        'label' => 'Extension No',
                ),
                'attributes' => array(
                        'type' => 'text',
                        'class' => 'form-control input-sm'
                ), 
        ));
        
        // Submit button.
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Add',
                'id'    => 'submitbutton',
                'class' => 'btn btn-primary'
            ),
        ));
    }
}