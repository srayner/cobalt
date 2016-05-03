<?php

namespace FAQ\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class HorizontalForm extends Form
{
    protected $labelWidth = 2;
    protected $controlWidth = 10;
    protected $compact = false;
    
    protected function addHidden($name)
    {
        $this->add(array(
            'type'    => 'hidden',
            'name'    => $name,
            'options' => array('column-size'=> "sm-$this->controlWidth")
        ));
        return $this;
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
    
    protected function addCheckbox($name, $label = null)
    {
        $this->add(array(
            'name' => $name,
            'type' => 'checkbox',
            'options' => array(
                'label' => $label,
                'column-size' => "sm-$this->controlWidth col-sm-offset-$this->labelWidth"
            )
        ));
        return $this;
    }
    
    protected function addMultiCheckbox($name, $label, array $data)
    {
        $multiCheckbox = new Element\MultiCheckbox($name);
        $multiCheckbox->setLabel($label);
        $multiCheckbox->setLabelAttributes(array('class' => "col-sm-$this->labelWidth"));
        $multiCheckbox->setValueOptions($data);
        $multiCheckbox->setOption('column-size', "sm-$this->controlWidth");
        $multiCheckbox->setOption('inline', true);
        $this->add($multiCheckbox);
        return $this;
    }
    
    protected function addRadio($name, $label, array $data)
    {
        $radio = new Element\Radio($name);
        $radio->setLabel($label);
        $radio->setLabelAttributes(array('class' => "col-sm-$this->labelWidth"));
        $radio->setValueOptions($data);
        $radio->setOption('column-size', "sm-$this->controlWidth");
        $radio->setOption('inline', true);
        $radio->setOption('disable-twb', true);
        $this->add($radio);
        return $this;
    }
    
    protected function addSelect($name, $label, array $values)
    {
        $select = new Element\Select($name);
        $select->setLabel($label);
        $select->setLabelAttributes(array('class' => "col-sm-$this->labelWidth"));
        $select->setOption('column-size', "sm-$this->controlWidth");
        $select->setValueOptions($values);
        
        if ($this->compact) {
            $select->setAttribute('class', 'input-sm');
        }
        
        $this->add($select);
        return $this;
    }
    
    protected function addDoctrineSelect($name, $label, $em, $entity, $property)
    {
        $select = $this->getFormFactory()->create(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => $name,
                'options' => array(
                'object_manager' => $em,
                'target_class'   => $entity,
                'property'       => $property,
            ),
        ));
        $select->setLabel($label);
        $select->setLabelAttributes(array('class' => "col-sm-$this->labelWidth"));
        $select->setOption('column-size', "sm-$this->controlWidth");
        if ($this->compact) {
            $select->setAttribute('class', 'input-sm');
        }
        
        $this->add($select);
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