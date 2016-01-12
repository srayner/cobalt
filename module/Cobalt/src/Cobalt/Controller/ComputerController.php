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
        // Create new form and hydrator instances.
        $form = $this->getServiceLocator()->get('cobalt_computer_form');
        $formHydrator = $this->getServiceLocator()->get('cobalt_form_hydrator');
         
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
          
            // Create a new computer object.
            $computer = $this->getServiceLocator()->get('cobalt_computer');
            
            $form->setHydrator($formHydrator);
            $form->bind($computer);
            $form->setData($data);
            if ($form->isValid())
            {
          	// Persist message.
            	$this->getComputerService()->persistComputer($computer);
                
            	// Redirect to list of computers
		return $this->redirect()->toRoute('assets/default', array(
		            'action'     => 'index'
		));
            }
        } 
        
        // If not a POST request, or invalid data, then just render the form.
        return array(
            'form'   => $form,
        );
    }
}