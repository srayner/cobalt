<?php

namespace Application\Form;

class MailServerForm extends AbstractForm
{
    public function __construct()
    {
        parent::__construct();
        
        $this->labelWidth = 3;
        $this->controlWidth = 9;
        $this->compact = true;
        
        $this->addText('name', 'Name')
             ->addText('host', 'Hostname')
             ->addText('port', 'Port')
             ->addText('ssl', 'SSL')
             ->addText('username', 'Username')
             ->addPassword('password', 'Password')
             ->addButton('submit', 'Submit', 'btn-primary');
    }   
}