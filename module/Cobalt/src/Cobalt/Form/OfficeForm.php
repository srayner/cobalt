<?php

namespace Cobalt\Form;

class OfficeForm extends HorizontalForm
{
    public function __construct()
    {
        parent::__construct();
        
        $this->compact = true;
        $this->labelWidth = 3;
        $this->controlWidth = 9;
        
        $this->addText('name', 'Office Name')
             ->addTextArea('address', 'Address', 5)
             ->addButton('submit', 'Add', 'btn-primary');   
    }
}
