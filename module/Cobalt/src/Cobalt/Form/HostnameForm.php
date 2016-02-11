<?php

namespace Cobalt\Form;

use Zend\Form\Form;

class HostNameForm extends Form
{
    public function __construct()
    {
        parent::__construct();
        
        $this->setAttribute('class', 'form-horizontal');
        
        $this->add(array(
                'name' => 'hostname',
                'options' => array(
                        'label' => 'Hostname',
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