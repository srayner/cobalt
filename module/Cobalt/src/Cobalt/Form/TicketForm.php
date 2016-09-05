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
        
        $this->addText('subject', 'Subject', true)
             ->addDoctrineSelect('type', 'Type', $em, 'Cobalt\Entity\TicketType', 'name')
             ->addDoctrineSelect('status', 'Status', $em, 'Cobalt\Entity\TicketStatus', 'name')
             ->addDoctrineSelect('priority', 'Priority', $em, 'Cobalt\Entity\TicketPriority', 'name')
             ->addDoctrineSelect('impact', 'Impact', $em, 'Cobalt\Entity\TicketImpact', 'name')
             ->addDoctrineSelect('category', 'Category', $em, 'Cobalt\Entity\TicketCategory', 'name')
             ->addText('requestor', 'Requestor')
             ->addTextArea('problem', 'Problem', 5)
             ->addFilteredDoctrineSelect('technician', 'Technician', $em, 'Cobalt\Entity\User', 'displayName', 'findTechnicians')
             ->addTextArea('solution', 'Solution', 5)
             ->addButton('submit', 'Add', 'btn-primary'); 
    }
}