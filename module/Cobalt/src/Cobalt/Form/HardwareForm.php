<?php

namespace Cobalt\Form;

class HardwareForm extends HorizontalForm
{
     protected $em;
    
    public function __construct($em)
    {
        parent::__construct();
        
        $this->em = $em;
        $this->compact = true;
        $this->labelWidth = 4;
        $this->controlWidth = 8;
        
        $this->addText('reference', 'Unique Reference')
             ->addText('name', 'Name')
             ->addDoctrineSelect('type', 'Type', $em, 'Cobalt\Entity\HardwareType', 'name')
             ->addDoctrineSelect('status', 'Status', $em, 'Cobalt\Entity\HardwareStatus', 'name')
             ->addText('model', 'Model')
             ->addText('serialNumber', 'Serial Number')
             ->addDoctrineSelect('manufacturer', 'Manufacturer', $em, 'Cobalt\Entity\HardwareManufacturer', 'name')
             ->addText('assetNumber', 'Asset Number')
             ->addTextArea('notes', 'Notes', 5)
             ->addButton('submit', 'Add', 'btn-primary');   
    }
}
