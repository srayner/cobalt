<?php

namespace Application\Form;

use Zend\Form\Form;

class DbConfigForm extends Form
{
    public function __construct()
    {
        parent::__construct();
        
        $this->add(array(
            'type'    => 'text',
            'name'    => 'Server Name',
        ));
        
        $this->add(array(
            'type'    => 'text',
            'name'    => 'Database Name',
        ));
        
        $this->add(array(
            'type'    => 'text',
            'name'    => 'Username',
        ));
        
        $this->add(array(
            'type'    => 'text',
            'name'    => 'Password',
        ));
    }
}