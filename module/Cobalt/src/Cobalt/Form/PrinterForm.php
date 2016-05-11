<?php

namespace Cobalt\Form;

class PrinterForm extends HardwareForm
{
    protected $em;
    
    public function __construct($em)
    {
        parent::__construct($em);
        
        
        $this->compact = true;
        $this->labelWidth = 4;
        $this->controlWidth = 8;
        
        $this->remove('type');
        
        $this->addText('technology', 'Technology')
             ->addText('resolution', 'Resolution')
             ->addText('speed', 'Speed')
             ->addText('quality', 'Quality')
             ->addText('dutyCycle', 'Duty Cycle')
             ->addButton('submit', 'Add', 'btn-primary');   
    }
}
