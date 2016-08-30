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
        
        $this->addText('username', 'Username', false, true)
             ->addPassword('password', 'Password')
             ->addText('displayName', 'Display Name')
             ->addText('emailAddress', 'Email Address')
             ->addText('telephoneNumber', 'Telephone Number')
             ->addText('extensionNumber', 'Extension Number')
             ->addText('mobileNumber', 'Mobile Number')
             ->addDoctrineSelect('company', 'Company', $em, 'Cobalt\Entity\Company', 'name')
             ->addDoctrineSelect('office', 'Office', $em, 'Cobalt\Entity\Office', 'name')
             ->addDoctrineSelect('department', 'Department', $em, 'Cobalt\Entity\Department', 'name')
             ->addDoctrineSelect('reportsTo', 'Reports To', $em, 'Cobalt\Entity\User', 'displayName')
             ->addButton('submit', 'Add', 'btn-primary');   
    }
}