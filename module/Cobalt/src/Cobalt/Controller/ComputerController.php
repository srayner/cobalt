<?php

namespace Cobalt\Controller;
use Zend\View\Model\ViewModel;

class ComputerController extends AbstractController
{
    public function indexAction()
    {
        return new ViewModel(array(
            'computers' => $this->service->findAll()
        ));
    }
    
    public function detailAction()
    {
        // Ensure we have an id, else redirect to index action.
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
             return $this->redirect()->toRoute('cobalt/default', array(
                 'controller' => 'computer',
             ));
        }

        return new ViewModel(array(
            'computer' => $this->service->findById($id)
        ));
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
            $computer = $this->getServiceLocator()->get('Cobalt\Computer');
            
            $form->bind($computer);
            $form->setData($data);
            if ($form->isValid())
            {
          	// Persist computer.
            	$this->service->persist($computer);
                
            	// Redirect to list of computers
		return $this->redirect()->toRoute('cobalt/default', array(
		    'controller' => 'computer',
                    'action'     => 'index'
		));
            }
        } 
        
        // If not a POST request, or invalid data, then just render the form.
        return new ViewModel(array(
            'form'   => $form
        ));
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
        $computer = $this->service->findById($id);
        
        $form = $this->getServiceLocator()->get('Cobalt\ComputerForm');
        $form->bind($computer);
        $form->get('submit')->setAttribute('value', 'Edit');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
        
            $form->setData($request->getPost());
            if ($form->isValid()) {
                
                // Persist computer.
            	$this->service->persist($computer);
                
                // Redirect to list of computers
                return $this->redirect()->toRoute('cobalt/default', array(
                    'controller' => 'computer'
                ));
            }     
        }
        
        return new ViewModel(array(
             'id' => $id,
             'form' => $form,
        ));
    }
    
    public function scanAction()
    {
        $form = $this->getServiceLocator()->get('Cobalt\HostnameForm');
        return new ViewModel(array(
            'form' => $form
        ));
    }
}