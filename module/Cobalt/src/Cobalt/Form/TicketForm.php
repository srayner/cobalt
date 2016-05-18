<?php

namespace Cobalt\Form;

class TicketForm extends HorizontalForm
{
    public function __construct($em)
    {
        parent::__construct();
        
        $this->compact = true;
        $this->labelWidth = 3;
        $this->controlWidth = 9;
        
        $this->setAttribute('class', 'form-horizontal');
        
        $this->addText('subject', 'Subject')
             ->addDoctrineSelect('type', 'Type', $em, 'Cobalt\Entity\TicketType', 'name')
             ->addDoctrineSelect('status', 'Status', $em, 'Cobalt\Entity\TicketStatus', 'name')
             ->addTextArea('problem', 'Problem', 5)
             ->addButton('submit', 'Add', 'btn-primary'); 
    }
}