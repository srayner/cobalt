<?php

namespace Project\Form;

class CommentForm extends HorizontalForm
{
    protected $em;
    
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        
        $this->compact = true;
        $this->labelWidth = 2;
        $this->controlWidth = 10;

        $this->addText('comment', 'Comment', false)
             ->addButton('submit', 'Add', 'btn-primary');
    }
}