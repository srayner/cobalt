<?php

namespace Cobalt\Form;

class DomainForm extends HorizontalForm
{
    public function __construct()
    {
        parent::__construct();
        
        $this->compact = true;
        $this->labelWidth = 4;
        $this->controlWidth = 8;
        
        $this->addText('name', 'Domain Name')
             ->addButton('submit', 'Add', 'btn-primary');   
    }
}
