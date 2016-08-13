<?php

namespace Cobalt\Form;

class ConsumableSelectForm extends HorizontalForm
{
    public function __construct($em)
    {
        parent::__construct();
        
        $this->compact = true;
        $this->labelWidth = 2;
        $this->controlWidth = 10;
        
        $this->setAttribute('class', 'form-horizontal');
        
        $this->addDoctrineSelect('consumable', 'Consumable', $em, 'Cobalt\Entity\Consumable', 'name')
             ->addButton('submit', 'Add', 'btn-primary'); 
    }
}