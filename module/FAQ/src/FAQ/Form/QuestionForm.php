<?php

namespace FAQ\Form;

class CompanyForm extends HorizontalForm
{
    public function __construct()
    {
        parent::__construct();
        
        $this->compact = true;
        $this->labelWidth = 4;
        $this->controlWidth = 8;
        
        $this->addText('question', 'Question')
             ->addTextArea('answer', 'Answer', 10)
             ->addButton('submit', 'Add', 'btn-primary');   
    }
}

