<?php

namespace Cobalt\Form;

class ComputerForm extends HardwareForm
{
    protected $em;
    
    public function __construct($em)
    {
        parent::__construct($em);
        
        $this->compact = true;
        $this->labelWidth = 4;
        $this->controlWidth = 8;
        
        $this->addText('hostname', 'Hostname', false)
             ->addText('domain', 'Domain')
             ->addText('image', 'Image')
             ->addButton('submit', 'Add', 'btn-primary');
    }
}