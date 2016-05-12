<?php

namespace Application\Form;

use Zend\Form\Form;

class DbConfigForm extends Form
{
    public function __construct()
    {
        parent::__construct();
        
        $this->addText('serverName', 'Server Name')
             ->addText('databaseName', 'Database Name')
             ->addText('username', 'username')
             ->addText('password', 'password');
    }
    
    private function addText($name, $label, $autocomplete = true)
    {
        $element = $this->getFormFactory()->create(array(
            'name' => $name,
            'type' => 'text',
            'options' => array(
                'label' => $label,
                'label_attributes' => array('class' => "col-sm-2"),
                'column-size' => "sm-9",
            )
        ));
        
        
       
        
        if ($autocomplete === false) {
            $element->setAttribute('autocomplete', 'off');
        }   
        
        $this->add($element);
        return $this;
    }
}