<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class HardwareManufacturerController extends AbstractController
{
    public function indexAction()
    {
        $manufacturers = $this->service->findAll();
        
        return new ViewModel(array(
            'manufacturers' => $manufacturers
        ));
    }
    
    public function addAction()
    {
        // Create a new form.
        $form = $this->getServiceLocator()->get('Cobalt\HardwareManufacturerForm');
         
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
          
            // Create a new manufacturer object.
            $manufacturer = $this->getServiceLocator()->get('Cobalt\HardwareManufacturer');
            
            $form->bind($manufacturer);
            $form->setData($data);
            if ($form->isValid())
            {
          	// Persist manufacturer.
            	$this->service->persist($manufacturer);
                
            	// Redirect to list of manufacturers
		return $this->redirect()->toRoute('cobalt/default', array(
		    'controller' => 'hardwaremanufacturer',
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
                 'controller' => 'hardwaremanufacturer',
                 'action' => 'add'
             ));
        }
        
        // Grab the manufacturer with the specified id.
        $manufacturer = $this->service->findById($id);
        
        $form = $this->getServiceLocator()->get('Cobalt\HardwareManufacturerForm');
        $form->bind($manufacturer);
        $form->get('submit')->setAttribute('value', 'Edit');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
        
            $form->setData($request->getPost());
            if ($form->isValid()) {
                
                // Persist manufacturer.
            	$this->service->persist($manufacturer);
                
                // Redirect to original referer
                return $this->redirect()->toUrl($this->retrieveReferer());
            }     
        }
        
        $this->storeReferer('hardwaremanufacturer/edit');
        
        return new ViewModel(array(
             'id' => $id,
             'form' => $form,
        ));
    }
    
    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        $manufacturer = $this->service->findById($id);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            // Only perform delete if value posted was 'Yes'.
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $this->service->remove($manufacturer);
            
                // Redirect to manufacturer index
                return $this->redirect()->toRoute('cobalt/default',
                    array('controller' => 'hardwaremanufacturer'));
            }
            
            // Redirect back to original referer
            return $this->redirect()->toUrl($this->retrieveReferer());
        }
        
        $this->storeReferer('hardwaremanufacturer/edit');
        
        return new ViewModel(array(
            'manufacturer' => $manufacturer
        ));
    }
    
    public function detailAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $manufacturer = $this->service->findById($id);
        
        // Get this history for this object.
        $historyService = $this->getServiceLocator()->get('Cobalt\HistoryService');
        $history = $historyService->find(303, $manufacturer->getId());
        
        return new ViewModel(array(
            'manufacturer' => $manufacturer,
            'history' => $history
        ));
    }
    
    private function storeReferer($except)
    {
        $referer = $this->getRequest()->getHeader('Referer')->uri()->getPath();
        if (strpos($referer, $except) === false) {
            $session = new Container('hardwaremanufacturer');
            $session->referer = $referer;
        }
    }
    
    private function retrieveReferer()
    {
        $session = new Container('hardwaremanufacturer');
        $referer = $session->referer;
        return $referer;
    }
}