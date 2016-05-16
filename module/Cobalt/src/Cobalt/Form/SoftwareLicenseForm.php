<?php

namespace Cobalt\Form;

class SoftwareLicenseForm extends HorizontalForm
{
    protected $em;
    
    public function __construct($em)
    {
        parent::__construct();
        
        $this->em = $em;
        $this->compact = true;
        $this->labelWidth = 4;
        $this->controlWidth = 8;
        
        $this->addDoctrineSelect('software', 'Software', $em, 'Cobalt\Entity\Software', 'name')
             ->addText('licenseKey', 'License Key')
             ->addText('installationsAllowed', 'Installations Allowed')
             ->addButton('submit', 'Add', 'btn-primary');   
    }
}


