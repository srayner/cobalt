<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class TicketPriorityController extends AbstractController
{
    public function indexAction()
    {
        return new ViewModel(array(
            'priorities' => $this->service->findAll()
        ));
    }
    
    public function addAction()
    {
        // Create a new form.
        $form = $this->getServiceLocator()->get('Cobalt\TicketPriorityForm');
         
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
          
            // Create a new priority object.
            $priority = $this->getServiceLocator()->get('Cobalt\TicketPriority');
            
            $form->bind($priority);
            $form->setData($data);
            if ($form->isValid())
            {
          	// Persist ticket priority.
            	$this->service->persist($priority);
                
            	// Redirect to list of ticket states
		return $this->redirect()->toRoute('cobalt/default', array(
		    'controller' => 'ticketpriority',
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
                 'controller' => 'ticketpriority',
                 'action' => 'add'
             ));
        }
        
        // Grab the priority with the specified id.
        $priority = $this->service->findById($id);
        
        $form = $this->getServiceLocator()->get('Cobalt\TicketPriorityForm');
        $form->bind($priority);
        $form->get('submit')->setAttribute('value', 'Edit');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
        
            $form->setData($request->getPost());
            if ($form->isValid()) {
                
                // Persist priority.
            	$this->service->persist($priority);
                
                // Redirect to original referer
                return $this->redirect()->toUrl($this->retrieveReferer());
            }     
        }
        
        $this->storeReferer('ticketpriority/edit');
        
        return new ViewModel(array(
             'id' => $id,
             'form' => $form,
        ));
    }
    
    public function detailAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $priority = $this->service->findById($id);
        return new ViewModel(array(
            'priority' => $priority
        ));    
    }
    
    private function storeReferer($except)
    {
        $referer = $this->getRequest()->getHeader('Referer')->uri()->getPath();
        if (strpos($referer, $except) === false) {
            $session = new Container('ticketpriority');
            $session->referer = $referer;
        }
    }
    
    private function retrieveReferer()
    {
        $session = new Container('ticketpriority');
        $referer = $session->referer;
        return $referer;
    }
}