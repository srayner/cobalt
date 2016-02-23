<?php

namespace Project\Form;

class TaskForm extends HorizontalForm
{
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
             ->addDoctrineSelect('status', 'Status', $em, 'Project\Entity\TaskStatus', 'name')
             ->addDoctrineSelect('priority', 'Priority', $em, 'Project\Entity\TaskPriority', 'name')
             ->addText('estimatedHours', 'Estimated Hours', false)
             ->addText('actualHours', 'Actual Hours', false)
             ->addButton('submit', 'Add', 'btn-primary');
    }
}