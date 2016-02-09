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
             ->addText('description', 'Description', false);
        
        // Status
        $values = $this->getStatusArray();
        $select = new Element\Select('status');
        $select->setLabel('Status');
        $select->setValueOptions($values);
        $this->add($select);
        
        // Priority
        $values = $this->getPriorityArray();
        $select = new Element\Select('priority');
        $select->setLabel('Priority');
        $select->setValueOptions($values);
        $this->add($select);
        
        $this->addButton('submit', 'Add', 'btn-primary');
    }
    
    private function getStatusArray()
    {
        $query = $this->em->createQuery("SELECT s FROM Project\Entity\MilestoneStatus s");
        $statuses = $query->getResult();
        $result = array();
        foreach($statuses as $status)
        {
            $result[$status->getId()] = $status->getName();
        }
        return $result;
    }
    
    private function getPriorityArray()
    {
        $query = $this->em->createQuery("SELECT p FROM Project\Entity\MilestonePriority p");
        $priorities = $query->getResult();
        $result = array();
        foreach($priorities as $priority)
        {
            $result[$priority->getId()] = $priority->getName();
        }
        return $result;
    }
    
}