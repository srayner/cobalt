<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class HardwareStatusController extends AbstractController
{
    public function indexAction()
    {
        $statuses = $this->service->findAll();
        
        return new ViewModel(array(
            'statuses' => $statuses
        ));
    }
    
    public function addAction()
    {
        // Create a new form.
        $form = $this->getServiceLocator()->get('Cobalt\HardwareStatusForm');
         
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
          
            // Create a new status object.
            $status = $this->getServiceLocator()->get('Cobalt\HardwareStatus');
            
            $form->bind($status);
            $form->setData($data);
            if ($form->isValid())
            {
          	// Persist status.
            	$this->service->persist($status);
                
            	// Redirect to list of statuses
		return $this->redirect()->toRoute('cobalt/default', array(
		    'controller' => 'hardwarestatus',
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
                 'controller' => 'hardwarestatus',
                 'action' => 'add'
             ));
        }
        
        // Grab the status with the specified id.
        $status = $this->service->findById($id);
        
        $form = $this->getServiceLocator()->get('Cobalt\HardwareStatusForm');
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
        
        $this->storeReferer('hardwarestatus/edit');
        
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
                    array('controller' => 'hardwarestatus'));
            }
            
            // Redirect back to original referer
            return $this->redirect()->toUrl($this->retrieveReferer());
        }
        
        $this->storeReferer('hardwarestatus/edit');
        
        return new ViewModel(array(
            'status' => $status
        ));
    }
    
    public function detailAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $status = $this->service->findById($id);
        
        // Get this history for this object.
        $historyService = $this->getServiceLocator()->get('Cobalt\HistoryService');
        $history = $historyService->find(302, $status->getID());
        
        return new ViewModel(array(
            'status' => $status,
            'history' => $history
        ));
    }
    
    private function storeReferer($except)
    {
        $referer = $this->getRequest()->getHeader('Referer')->uri()->getPath();
        if (strpos($referer, $except) === false) {
            $session = new Container('hardwarestatus');
            $session->referer = $referer;
        }
    }
    
    private function retrieveReferer()
    {
        $session = new Container('hardwarestatus');
        $referer = $session->referer;
        return $referer;
    }
}