<?php

namespace Application\Form;

class DbConfigForm extends AbstractForm
{   
    public function __construct()
    {
        parent::__construct();
        
        $this->labelWidth = 3;
        $this->controlWidth = 9;
        $this->compact = true;
        
        $this->addText('hostname', 'Hostname')
             ->addText('database', 'Database')
             ->addText('username', 'Username')
             ->addPassword('password', 'Password')
             ->addButton('submit', 'Submit', 'btn-primary');
    }
}