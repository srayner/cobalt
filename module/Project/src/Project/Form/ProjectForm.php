<?php

namespace Project\Form;

use Zend\Form\Element;
use \Doctrine\ORM\Query;

class ProjectForm extends HorizontalForm
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
             ->addText('code', 'Code', false)
             ->addText('name', 'Name', false)
             ->addText('description', 'Description', false)
             ->addText('estimatedHours', 'Estimated Hours', false)
             ->addText('actualHours', 'Actual Hours', false)
             ->addText('estimatedCost', 'Estimated Cost', false)
             ->addText('actualCost', 'Actual Cost', false)
             ->addDoctrineSelect('status', 'Status', $em, 'Project\Entity\ProjectStatus', 'name')
             ->addDoctrineSelect('priority', 'Priority', $em, 'Project\Entity\ProjectPriority', 'name')
             ->addButton('submit', 'Add', 'btn-primary');
    }
}