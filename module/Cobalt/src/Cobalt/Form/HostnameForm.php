<?php

namespace Cobalt\Form;

class HostnameForm extends HorizontalForm
{
    public function __construct()
    {
        parent::__construct();
        
        $this->compact = true;
        $this->labelWidth = 3;
        $this->controlWidth = 9;
        
        $this->setAttribute('class', 'form-horizontal');
        
        $this->addText('hostname', 'Hostname')
             ->addButton('submit', 'Scan', 'btn-primary'); 
    }
}