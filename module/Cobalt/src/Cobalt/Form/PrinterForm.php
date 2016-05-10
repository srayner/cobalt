<?php

namespace Cobalt\Form;

class HardwareForm extends HorizontalForm
{
    protected $em;
    
    public function __construct($em)
    {
        parent::__construct();
        
        $this->em = $em;
        $this->compact = true;
        $this->labelWidth = 4;
        $this->controlWidth = 8;
        
        $this->addText('technology', 'Technology')
             ->addButton('submit', 'Add', 'btn-primary');   
    }
}
