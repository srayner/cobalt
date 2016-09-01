<?php

namespace Application\Form;

use Zend\Form\Form;

abstract class AbstractForm extends Form
{
    protected $compact;
    protected $labelWidth;
    protected $controlWidth;
    
    public function __construct()
    {
        parent::__construct();   
    }
    
    protected function addText($name, $label, $autocomplete = true)
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
        
        if ($this->compact) {
            $element->setAttribute('class', 'input-sm');
        }
        
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
    
    private function append($existing, $new)
    {
        if (isset($existing) && ('' !== $existing)) {
            return $existing . ' ' . $new;
        }
        return $new;
    }
}