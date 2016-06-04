<?php

namespace Application\Form;

use Zend\Form\Form;

class TemplateForm extends Form
{
    protected $labelWidth;
    protected $controlWidth;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->labelWidth = 1;
        $this->controlWidth = 11;
                
        $this->addTextArea('template', 'Template', 16)
             ->addButton('submit', 'Submit', 'btn-primary');
    }
    
    protected function addTextArea($name, $label, $rows = 4)
    {
        $element = $this->getFormFactory()->create(array(
            'name' => $name,
            'type' => 'textarea',
            'options' => array(
                'label' => $label,
                'label_attributes' => array('class' => "col-sm-$this->labelWidth"),
                'column-size' => "sm-$this->controlWidth"
            ),
        ));
        
        $element->setAttribute('rows', $rows);
        
        if ($this->compact) {
            $element->setAttribute('class', 'input-sm');
        }
        
        $this->add($element);
        return $this;
    }
    
    protected function addButton($name, $label, $class = null)
    {
        if ($this->compact) {
            $class = $this->append($class, 'btn-sm');
        }
        
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