<?php

namespace Cobalt\Form;

class ConsumableForm extends HorizontalForm
{
    public function __construct()
    {
        parent::__construct();
        
        $this->compact = true;
        $this->labelWidth = 4;
        $this->controlWidth = 8;
        
        $this->addText('name', 'Name')
             ->addTextArea('description', 'Description', 5)
             ->addButton('submit', 'Add', 'btn-primary');   
    }
}