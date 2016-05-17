<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class TicketStatusController extends AbstractController
{
    public function indexAction()
    {
        return new ViewModel(array(
            'states' => $this->service->findAll()
        ));
    }
    
    public function addAction()
    {
        // Create a new form.
        $form = $this->getServiceLocator()->get('Cobalt\TicketStatusForm');
         
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
          
            // Create a new hardware object.
            $status = $this->getServiceLocator()->get('Cobalt\TicketStatus');
            
            $form->bind($status);
            $form->setData($data);
            if ($form->isValid())
            {
          	// Persist ticket status.
            	$this->service->persist($status);
                
            	// Redirect to list of ticket states
		return $this->redirect()->toRoute('cobalt/default', array(
		    'controller' => 'ticketstatus',
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
                 'controller' => 'ticketstatus',
                 'action' => 'add'
             ));
        }
        
        // Grab the status with the specified id.
        $status = $this->service->findById($id);
        
        $form = $this->getServiceLocator()->get('Cobalt\TicketStatusForm');
        $form->bind($status);
        $form->get('submit')->setAttribute('value', 'Edit');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
        
            $form->setData($request->getPost());
            if ($form->isValid()) {
                
                // Persist status.
            	$this->service->persist($status);
                
                // Redirect to original referer
                return $this->redirect()->toUrl($this->retrieveReferer());
            }     
        }
        
        $this->storeReferer('ticketstatus/edit');
        
        return new ViewModel(array(
             'id' => $id,
             'form' => $form,
        ));
        
    }
    
    public function deleteAction()
    {
        
        $id = (int)$this->params()->fromRoute('id');
        $status = $this->service->findById($id);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            // Only perform delete if value posted was 'Yes'.
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $this->service->remove($status);
            
                // Redirect to status index
                return $this->redirect()->toRoute('cobalt/default',
                    array('controller' => 'ticketstatus'));
            }
            
            // Redirect back to original referer
            return $this->redirect()->toUrl($this->retrieveReferer());
        }
        
        $this->storeReferer('ticketstatus/delete');
        
        return new ViewModel(array(
            'status' => $status
        ));
        
    }
    
    public function detailAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $status = $this->service->findById($id);
        return new ViewModel(array(
            'status' => $status
        ));    
    }
    
    private function storeReferer($except)
    {
        $referer = $this->getRequest()->getHeader('Referer')->uri()->getPath();
        if (strpos($referer, $except) === false) {
            $session = new Container('ticketstatus');
            $session->referer = $referer;
        }
    }
    
    private function retrieveReferer()
    {
        $session = new Container('ticketstatus');
        $referer = $session->referer;
        return $referer;
    }
    
    
}