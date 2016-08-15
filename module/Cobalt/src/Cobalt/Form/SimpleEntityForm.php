<?php

namespace Cobalt\Form;

class SimpleEntityForm extends HorizontalForm
{
    public function __construct()
    {
        parent::__construct();
        
        $this->compact = true;
        $this->labelWidth = 4;
        $this->controlWidth = 8;
        
        $this->addText('name', 'Name')
             ->addTextArea('description', 'Description', 5)
             ->addSelect('color', 'Colour', array(
                 '#0000FF' => 'Red',
                 '#00FF00' => 'Green',
                 '#FF0000' => 'Blue'
             ))
             ->addButton('submit', 'Add', 'btn-primary');   
    }
}