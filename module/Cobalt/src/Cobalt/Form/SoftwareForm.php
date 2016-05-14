<?php

namespace Cobalt\Form;

class SoftwareForm extends HorizontalForm
{
    public function __construct($em)
    {
        parent::__construct();
        
        $this->compact = true;
        $this->labelWidth = 4;
        $this->controlWidth = 8;
        
        $this->addText('name', 'Name')
             ->addText('version', 'Version')
             ->addDoctrineSelect('manufacturer', 'Manufacture', $em, 'Cobalt\Entity\SoftwareManufacturer', 'name')
             ->addDoctrineSelect('type', 'Type', $em, 'Cobalt\Entity\SoftwareType', 'name')
             ->addDoctrineSelect('category', 'Category', $em, 'Cobalt\Entity\SoftwareCategory', 'name')
             ->addButton('submit', 'Add', 'btn-primary');   
    }
}

