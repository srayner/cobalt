<?php

namespace Project\Form;

use Zend\Form\Element;

class MilestoneForm extends HorizontalForm
{
    protected $em;
    
    public function __construct($em, $name = null, $options = array())
    {
        parent::__construct($name, $options);
        
        $this->em = $em;
        
        $this->compact = true;
        $this->labelWidth = 2;
        $this->controlWidth = 10;

        $this->addHidden('id')
             ->addText('name', 'Name', false)
             ->addText('description', 'Description', false)
             ->addDoctrineSelect('status', 'Status', $em, 'Project\Entity\ProjectStatus', 'name')
             ->addDoctrineSelect('priority', 'Priority', $em, 'Project\Entity\ProjectPriority', 'name')
             ->addButton('submit', 'Add', 'btn-primary');
    }
}