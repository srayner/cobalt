<?php

namespace Cobalt\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class ComputerController extends AbstractActionController
{
    protected $computerService;
    
    private function getComputerService()
    {
        if (null === $this->computerService){
            $this->computerService = $this->getServiceLocator()->get('cobalt_computer_service');
        }
        return $this->computerService;
    }
    
    public function indexAction()
    {
        $computers = $this->getComputerService()->getComputers();
        return array(
            'computers' => $computers
        );
    }
    
    public function detailAction()
    {
        $computerId = $this->params()->fromRoute('id');
        $computer = $this->getComputerService()->getComputerById($computerId);
        $logicalDisks = $this->getComputerService()->getLogicalDisks($computerId);
        return array(
            'computer' => $computer,
            'disks' => $logicalDisks
        );
    }
    
    public function addAction()
    {
        // Create a new form.
        $form = $this->getServiceLocator()->get('Cobalt\ComputerForm');
         
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
          
            // Create a new computer object.
            $computer = $this->getServiceLocator()->get('cobalt_computer');
            
            $form->bind($computer);
            $form->setData($data);
            if ($form->isValid())
            {
          	// Persist message.
            	$this->getComputerService()->persistComputer($computer);
                
            	// Redirect to list of computers
		return $this->redirect()->toRoute('cobalt/default', array(
		    'controller' => 'computer',
                    'action'     => 'index'
		));
            }
        } 
        
        // If not a POST request, or invalid data, then just render the form.
        return array(
            'form'   => $form,
        );
    }
    
    public function editAction()
    {
        // Ensure we have an id, else redirect to add action.
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
             return $this->redirect()->toRoute('cobalt/default', array(
                 'controller' => 'computer',
                 'action' => 'add'
             ));
        }
        
        // Grab the computer with the specified id.
        $computer = $this->getComputerService()->getComputerById($id);
        
        $form = $this->getServiceLocator()->get('Cobalt\ComputerForm');
        $form->bind($computer);
        $form->get('submit')->setAttribute('value', 'Edit');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
        
            $form->setData($request->getPost());
            if ($form->isValid()) {
                
                // Persist hazard.
            	$this->getComputerService()->persistComputer($computer);
                
                // Redirect to list of computers
                return $this->redirect()->toRoute('cobalt/default', array(
                    'controller' => 'computer',
                    'action' => 'index'
                ));
            }     
        }
        
        return array(
             'id' => $id,
             'form' => $form,
        );   
    }
}