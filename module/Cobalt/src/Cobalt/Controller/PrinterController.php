<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class PrinterController extends AbstractController
{
    public function indexAction()
    {
        $printers = $this->service->findAll();
        
        return new ViewModel(array(
            'printers' => $printers
        ));
    }
    
    public function addAction()
    {
        // Create a new form.
        $form = $this->getServiceLocator()->get('Cobalt\PrinterForm');
         
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
          
            // Create a new hardware object.
            $printer = $this->getServiceLocator()->get('Cobalt\Printer');
            
            $form->bind($printer);
            $form->setData($data);
            if ($form->isValid())
            {
          	// Persist printer.
                $this->service->setType($printer, 'Printer');
            	$this->service->persist($printer);
                
            	// Redirect to list of printers
		return $this->redirect()->toRoute('cobalt/default', array(
		    'controller' => 'printer',
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
                 'controller' => 'printer',
                 'action' => 'add'
             ));
        }
        
        // Grab the status with the specified id.
        $printer = $this->service->findById($id);
        
        $form = $this->getServiceLocator()->get('Cobalt\PrinterForm');
        $form->bind($printer);
        $form->get('submit')->setAttribute('value', 'Edit');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
        
            $form->setData($request->getPost());
            if ($form->isValid()) {
                
                // Persist status.
            	$this->service->persist($printer);
                
                // Redirect to original referer
                return $this->redirect()->toUrl($this->retrieveReferer());
            }     
        }
        
        $this->storeReferer('printer/edit');
        
        return new ViewModel(array(
             'id' => $id,
             'form' => $form,
        ));
    }
    
    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        $printer = $this->service->findById($id);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            // Only perform delete if value posted was 'Yes'.
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $this->service->remove($printer);
            
                // Redirect to status index
                return $this->redirect()->toRoute('cobalt/default',
                    array('controller' => 'printer'));
            }
            
            // Redirect back to original referer
            return $this->redirect()->toUrl($this->retrieveReferer());
        }
        
        $this->storeReferer('printer/delete');
        
        return new ViewModel(array(
            'printer' => $printer
        ));
    }
    
    public function detailAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $printer = $this->service->findById($id);
        
        // Get this history for this object.
        $historyService = $this->getServiceLocator()->get('Cobalt\HistoryService');
        $history = $historyService->find(300, $printer->getID());
        
        return new ViewModel(array(
            'printer' => $printer,
            'history' => $history
        ));
        
    }
    
    public function addconsumableAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        
        $form = $this->getServiceLocator()->get('Cobalt\ConsumableSelectForm');
        
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
            $form->setData($data);
            if ($form->isValid())
            {
                // Grab the status with the specified id.
                $printer = $this->service->findById($id);
                $consumable = $this->service->getReference('Cobalt\Entity\Consumable', $data['consumable']);
                $printer->addConsumable($consumable);
                $this->service->persist($printer);
                
                // Redirect back to printer
                return $this->redirect()->toRoute('cobalt/default', array(
                    'controller' => 'printer',
                    'action' => 'detail',
                    'id' => $id
                ));
            }
        }
        
        return array(
            'form' => $form,
            'printerId' => $id
        );
    }
    
    public function removeconsumableAction()
    {
        // Extract identifiers from route param.
        $params = explode('_', $this->params()->fromRoute('id'));
        $printerId = $params[0];
        $consumableId = $params[1];
        
        $consumableService = $this->getServiceLocator()->get('Cobalt\EntityService\ConsumableService');
        $consumable = $consumableService->findById($consumableId);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
              // Only perform delete if value posted was 'Yes'.
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $printer = $this->service->findById($printerId);
                $printer->removeConsumable($consumable);
                $this->service->persist($printer);
            }
            
             // Redirect to list of consumables
            return $this->redirect()->toRoute('cobalt/default', array(
                'controller' => 'printer',
                'action' => 'detail',
                'id' => $printerId
            ), array('fragment'=>'consumables'));
                
        }
        
        return new ViewModel(array(
            'printerId' => $printerId,
            'consumable' => $consumable 
        ));
    }
    
    private function storeReferer($except)
    {
        $referer = $this->getRequest()->getHeader('Referer')->uri()->getPath();
        if (strpos($referer, $except) === false) {
            $session = new Container('printer');
            $session->referer = $referer;
        }
    }
    
    private function retrieveReferer()
    {
        $session = new Container('printer');
        $referer = $session->referer;
        return $referer;
    }
}