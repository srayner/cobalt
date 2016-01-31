<?php

namespace Project\Form;

class MilestoneForm extends HorizontalForm
{
    protected $em;
    
    public function __construct($em, $name = null, $options = array())
    {
        parent::__construct($name, $options);
        
        $this->em = $em;
        
        $this->compact = true;
        $this->labelWidth = 2;
        $this->controlWidth = 10;

        $this->addHidden('id')
             ->addText('name', 'Name', false)
             ->addText('description', 'Description', false);
        
        $this->addButton('submit', 'Add', 'btn-primary');
    }
    
}