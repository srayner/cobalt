<?php

namespace Cobalt\Form;

class UserForm extends HorizontalForm
{
    public function __construct()
    {
        parent::__construct();
        
        $this->compact = true;
        $this->labelWidth = 4;
        $this->controlWidth = 8;
        
        $this->addText('username', 'Username')
             ->addText('displayName', 'Display Name')
             ->addText('office', 'Office')
             ->addText('email', 'Email Address')
             ->addText('telephoneNumber', 'Telephone Number')
             ->addText('extensionNumber', 'Extension Number')
             ->addButton('submit', 'Add', 'btn-primary');   
    }
}