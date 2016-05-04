<?php

namespace Cobalt\Form;

class DepartmentForm extends HorizontalForm
{
    public function __construct()
    {
        parent::__construct();
        
        $this->compact = true;
        $this->labelWidth = 4;
        $this->controlWidth = 8;
        
        $this->addText('name', 'Department Name')
             ->addTextArea('description', 'Description', 5)
             ->addText('phone', 'Telephone No')
             ->addText('fax', 'Fax No')
             ->addButton('submit', 'Add', 'btn-primary');   
    }
}