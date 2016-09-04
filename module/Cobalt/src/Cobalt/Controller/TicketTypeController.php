<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class TicketTypeController extends AbstractController
{
    public function indexAction()
    {
        return new ViewModel(array(
            'types' => $this->service->findAll()
        ));
    }
    
    public function addAction()
    {
        // Create a new form.
        $form = $this->getServiceLocator()->get('Cobalt\TicketTypeForm');
         
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
          
            // Create a new hardware object.
            $type = $this->getServiceLocator()->get('Cobalt\TicketType');
            
            $form->bind($type);
            $form->setData($data);
            if ($form->isValid())
            {
          	// Persist ticket type.
            	$this->service->persist($type);
                
            	// Redirect to list of ticket types
		return $this->redirect()->toRoute('cobalt/default', array(
		    'controller' => 'tickettype',
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
                 'controller' => 'tickettype',
                 'action' => 'add'
             ));
        }
        
        // Grab the type with the specified id.
        $type = $this->service->findById($id);
        
        $form = $this->getServiceLocator()->get('Cobalt\TicketTypeForm');
        $form->bind($type);
        $form->get('submit')->setAttribute('value', 'Edit');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
        
            $form->setData($request->getPost());
            if ($form->isValid()) {
                
                // Persist type.
            	$this->service->persist($type);
                
                // Redirect to original referer
                return $this->redirect()->toUrl($this->retrieveReferer());
            }     
        }
        
        $this->storeReferer('tickettype/edit');
        
        return new ViewModel(array(
             'id' => $id,
             'form' => $form,
        ));
    }
    
    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        $type = $this->service->findById($id);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            // Only perform delete if value posted was 'Yes'.
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $this->service->remove($type);
            
                // Redirect to status index
                return $this->redirect()->toRoute('cobalt/default',
                    array('controller' => 'tickettype'));
            }
            
            // Redirect back to original referer
            return $this->redirect()->toUrl($this->retrieveReferer());
        }
        
        $this->storeReferer('tickettype/delete');
        
        return new ViewModel(array(
            'type' => $type
        ));
        
    }
    
    public function detailAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $type = $this->service->findById($id);
        
         // Get this history for this object.
        $historyService = $this->getServiceLocator()->get('Cobalt\HistoryService');
        $history = $historyService->find(601, $type->getID());
        
        return new ViewModel(array(
            'type' => $type,
            'history' => $history
        ));    
    }
    
    private function storeReferer($except)
    {
        $referer = $this->getRequest()->getHeader('Referer')->uri()->getPath();
        if (strpos($referer, $except) === false) {
            $session = new Container('tickettype');
            $session->referer = $referer;
        }
    }
    
    private function retrieveReferer()
    {
        $session = new Container('tickettype');
        $referer = $session->referer;
        return $referer;
    }
}