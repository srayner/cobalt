<?php

namespace Application\Form;

class AdConfigForm extends AbstractForm
{   
    public function __construct()
    {
        parent::__construct();
        
        $this->compact = true;
        $this->labelWidth = 4;
        $this->controlWidth = 8;
                
        $this->addText('domain_name', 'Domain Name')
             ->addText('domain_name_short', 'Short Domain Name')
             ->addText('domain_controller', 'Domain Controller')
             ->addText('ldap_port', 'LDAP Port Number')
             ->addText('user', 'Username')
             ->addPassword('password', 'Password')
             ->addText('use_start_tls', 'Use Start TLS')
             ->addText('baseDn', 'Base DN')
             ->addButton('submit', 'Submit', 'btn-primary');
    }   
}