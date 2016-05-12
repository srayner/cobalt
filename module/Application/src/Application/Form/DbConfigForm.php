<?php

namespace Application\Form;

use Zend\Form\Form;

class DbConfigForm extends Form
{
    protected $labelWidth;
    protected $controlWidth;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->labelWidth = 3;
        $this->controlWidth = 9;
        
        $this->addText('serverName', 'Server Name')
             ->addText('databaseName', 'Database Name')
             ->addText('Username', 'Username')
             ->addPassword('Password', 'Password')
             ->addButton('submit', 'Submit', 'btn-primary');
    }
    
    private function addText($name, $label, $autocomplete = true)
    {
        $element = $this->getFormFactory()->create(array(
            'name' => $name,
            'type' => 'text',
            'options' => array(
                'label' => $label,
                'label_attributes' => array('class' => "col-sm-$this->labelWidth"),
                'column-size' => "sm-$this->controlWidth",
            )
        ));
        
        if ($autocomplete === false) {
            $element->setAttribute('autocomplete', 'off');
        }   
        
        $this->add($element);
        return $this;
    }
    
    protected function addPassword($name, $label)
    {
        $element = $this->getFormFactory()->create(array(
            'name' => $name,
            'type' => 'password',
            'options' => array(
                'label' => $label,
                'label_attributes' => array('class' => "col-sm-$this->labelWidth"),
                'column-size' => "sm-$this->controlWidth",
            ),
            'attributes' => array(
                'type' => 'password'
            ),
        ));
        
        if ($this->compact) {
            $element->setAttribute('class', 'input-sm');
        }
                
        $this->add($element);
        return $this;
    }
    
    protected function addButton($name, $label, $class = null)
    {
        
        // Add the submit button
        $this->add(array(
            'name' => $name,
            'type' => 'button',
            'attributes' => array('type' => 'submit',
                                  'class' => $class),
            'options' => array(
                'label' => $label,
                'column-size' => "sm-$this->controlWidth col-sm-offset-$this->labelWidth"
            )
        ));
        return $this;
    }
}