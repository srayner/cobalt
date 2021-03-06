<?php

namespace Cobalt\Form;

class CompanyForm extends HorizontalForm
{
    public function __construct()
    {
        parent::__construct();
        
        $this->compact = true;
        $this->labelWidth = 4;
        $this->controlWidth = 8;
        
        $this->addText('name', 'Company Name')
             ->addTextArea('address', 'Registered Address', 5)
             ->addText('phone', 'Telephone No')
             ->addText('fax', 'Fax No')
             ->addButton('submit', 'Add', 'btn-primary');   
    }
}