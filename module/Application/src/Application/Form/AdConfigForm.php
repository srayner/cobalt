<?php

namespace Application\Form;

use Zend\Form\Form;

class AdConfigForm extends Form
{
    protected $labelWidth;
    protected $controlWidth;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->labelWidth = 4;
        $this->controlWidth = 8;
                
        $this->addText('domain_name', 'Domain Name')
             ->addText('domain_name_short', 'Short Domain Name')
             ->addText('domain_controller', 'Domain Controller')
             ->addText('ldap_port', 'LDAP Port Number')
             ->addText('user', 'Username')
             ->addPassword('password', 'Password')
             ->addText('use_start_tls', 'Use Start TLS')
             ->addText('baseDn', 'Base DN')
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