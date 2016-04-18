<?php

namespace Cobalt\Form;

class UserForm extends HorizontalForm
{
    protected $em;
    
    public function __construct($em)
    {
        parent::__construct();
        
        $this->em = $em;
        $this->compact = true;
        $this->labelWidth = 4;
        $this->controlWidth = 8;
        
        $this->addText('username', 'Username')
             ->addText('displayName', 'Display Name')
             ->addText('office', 'Office')
             ->addText('email', 'Email Address')
             ->addText('telephoneNumber', 'Telephone Number')
             ->addText('extensionNumber', 'Extension Number')
             ->addText('mobileNumber', 'Mobile Number')
             ->addDoctrineSelect('reportsTo', 'Reports To', $em, 'Cobalt\Entity\User', 'displayName')
             ->addButton('submit', 'Add', 'btn-primary');   
    }
}