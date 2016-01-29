<?php

namespace Cobalt\Form;

use Zend\Form\Form;

class ComputerForm extends Form
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
        
        $this->add(array(
                'name' => 'domain',
                'options' => array(
                        'label' => 'Domain',
                ),
                'attributes' => array(
                        'type' => 'text',
                        'class' => 'form-control input-sm'
                ), 
        ));
        
        $this->add(array(
                'name' => 'manufacturer',
                'options' => array(
                        'label' => 'Manufacturer',
                ),
                'attributes' => array(
                        'type' => 'text',
                        'class' => 'form-control input-sm'
                ), 
        ));
        
        $this->add(array(
                'name' => 'model',
                'options' => array(
                        'label' => 'Model',
                ),
                'attributes' => array(
                        'type' => 'text',
                        'class' => 'form-control input-sm'
                ), 
        ));
        
        $this->add(array(
                'name' => 'image',
                'options' => array(
                        'label' => 'Image',
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