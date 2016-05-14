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
             ->addDoctrineSelect('manufacturer', 'Manufacture', $em, 'SoftwareManufacturer', 'name')
             ->addDoctrineSelect('type', 'Type', $em, 'SoftwareType', 'name')
             ->addDoctrineSelect('category', 'Category', $em, 'SoftwareCategory', 'name')
             ->addButton('submit', 'Add', 'btn-primary');   
    }
}

