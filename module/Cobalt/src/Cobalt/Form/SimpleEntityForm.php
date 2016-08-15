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
                 '#d00'    => 'Red',
                 '#daa520' => 'Amber',
                 '#5cb85c' => 'Green',
                 '#00d'    => 'Blue',
                 '#777'    => 'Gray'
             ))
             ->addButton('submit', 'Add', 'btn-primary');   
    }
}