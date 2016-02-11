<?php

namespace Project\Form;

class TaskForm extends HorizontalForm
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        
        $this->compact = true;
        $this->labelWidth = 2;
        $this->controlWidth = 10;
        
        $this->addHidden('id')
             ->addText('name', 'Name', false)
             ->addText('description', 'Description', false)
             ->addText('estimatedHours', 'Estimated Hours', false)
             ->addText('actualHours', 'Actual Hours', false)
             ->addButton('submit', 'Add', 'btn-primary');
    }
}