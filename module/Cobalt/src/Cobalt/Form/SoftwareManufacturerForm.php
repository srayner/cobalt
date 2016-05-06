<?php

namespace Cobalt\Form;

class SoftwareManufacturerForm extends HorizontalForm
{
    public function __construct()
    {
        parent::__construct();
        
        $this->compact = true;
        $this->labelWidth = 3;
        $this->controlWidth = 9;
        
        $this->addText('name', 'Name')
             ->addTextArea('address', 'Address', 5)
             ->addText('supportEmail', 'Support Email')
             ->addText('websiteUrl', 'Website URL')
             ->addButton('submit', 'Add', 'btn-primary');   
    }
}