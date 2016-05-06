<?php

namespace Cobalt\Form;

class SoftwareTypeForm extends HorizontalForm
{
    public function __construct()
    {
        parent::__construct();
        
        $this->compact = true;
        $this->labelWidth = 3;
        $this->controlWidth = 9;
        
        $this->addText('name', 'Name')
             ->addTextArea('description', 'Description', 5)
             ->addButton('submit', 'Add', 'btn-primary');   
    }
}