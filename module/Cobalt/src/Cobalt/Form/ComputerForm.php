<?php

namespace Cobalt\Form;

class ComputerForm extends HorizontalForm
{
    public function __construct()
    {
        parent::__construct();
        
        $this->compact = true;
        $this->labelWidth = 2;
        $this->controlWidth = 10;
        
        $this->addText('hostname', 'Hostname', false, true)
             ->addText('domain', 'Domain')
             ->addText('manufacturer', 'Manufacturer')
             ->addText('model', 'Model')
             ->addText('image', 'Image')
             ->addButton('submit', 'Add', 'btn-primary');
    }
}