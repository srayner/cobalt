<?php

namespace Cobalt\Form;

class HardwareForm extends HorizontalForm
{
    public function __construct()
    {
        parent::__construct();
        
        $this->compact = true;
        $this->labelWidth = 4;
        $this->controlWidth = 8;
        
        $this->addText('reference', 'Unique Reference')
             ->addTextArea('assetNumber', 'Asset Number', 5)
             ->addButton('submit', 'Add', 'btn-primary');   
    }
}
