<?php

namespace Cobalt\Form;

class TicketForm extends HorizontalForm
{
    public function __construct($em)
    {
        parent::__construct();
        
        $this->compact = true;
        $this->labelWidth = 1;
        $this->controlWidth = 11;
        
        $this->setAttribute('class', 'form-horizontal');
        
        $this->addText('subject', 'Subject')
             ->addDoctrineSelect('type', 'Type', $em, 'Cobalt\Entity\TicketType', 'name')
             ->addDoctrineSelect('status', 'Status', $em, 'Cobalt\Entity\TicketStatus', 'name')
             ->addDoctrineSelect('priority', 'Priority', $em, 'Cobalt\Entity\TicketPriority', 'name')
             ->addDoctrineSelect('impact', 'Impact', $em, 'Cobalt\Entity\TicketImpact', 'name')
             ->addDoctrineSelect('category', 'Category', $em, 'Cobalt\Entity\TicketCategory', 'name')
             ->addDoctrineSelect('requestor', 'Requestor', $em, 'Cobalt\Entity\User', 'displayName')
             ->addTextArea('problem', 'Problem', 5)
             ->addDoctrineSelect('technician', 'Technician', $em, 'Cobalt\Entity\User', 'displayName')
             ->addButton('submit', 'Add', 'btn-primary'); 
    }
}