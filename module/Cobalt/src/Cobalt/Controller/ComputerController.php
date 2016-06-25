<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

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

        // Get a copy of the computer object.
        $computer = $this->service->findById($id);
                
        // Get this history for this object.
        $historyService = $this->getServiceLocator()->get('Cobalt\HistoryService');
        $history = $historyService->find(2, $computer->getID());
        
        // Pass the object and the history to the view.
        return new ViewModel(array(
            'computer' => $computer,
            'history' => $history
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
    
    public function deleteAction()
    {
        // Ensure we have an id, else redirect to index action.
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('cobalt/default', array('controller' => 'computer'));
        }
        
        $computer = $this->service->findById($id);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            // Only perform delete if value posted was 'Yes'.
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $this->service->remove($computer);
            }

            // Redirect to list of users
            return $this->redirect()->toRoute('cobalt/default', array('controller' => 'computer'));
         }
         
        return new ViewModel(array(
            'computer' => $computer
        ));
    }
    
    public function oldscanAction()
    {
        $form = $this->getServiceLocator()->get('Cobalt\HostnameForm');
        
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                
                $hostname = $form->getInputFilter()->getValue('hostname');
                $wmiService = $this->getServiceLocator()->get('Cobalt\WMIService');
                $wmiService->scanComputer($hostname, $this->service);
                
                // Redirect to list of computers
                return $this->redirect()->toRoute('cobalt/default', array(
                    'controller' => 'computer'
                )); 
            }
     
        }
        
        return new ViewModel(array(
            'form' => $form
        ));
    }
    
    public function scanAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('cobalt/default', array('controller' => 'computer'));
        }
        
        // Check if the request is a POST.
        $request = $this->getRequest();
        
        $computer = $this->service->findById($id);
        $hostname = $computer->getHostname();
        $domain = $computer->getDomain();
        $wmiService = $this->getServiceLocator()->get('Cobalt\WMIService');
        $wmiService->scanComputer($hostname, $domain, $this->service);
                
        // Redirect to computer detail
        return $this->redirect()->toRoute('cobalt/default', array(
            'controller' => 'computer',
            'action' => 'detail',
            'id' => $id
        )); 
    }
    
    public function adupdateAction()
    {
        $adService = $this->getServiceLocator()->get('Cobalt\ActiveDirectoryService');
        $adService->getComputers($this->service);
    
        return array();
    }
    
    public function pingAction()
    {
        $status = 'unknown';
        
        $id = (int)$this->params()->fromRoute('id');
        if ($id) {
            $computer = $this->service->findById($id);
            $hostname = $computer->getHostname();
            if ($hostname) {
                $status = $this->ping($hostname);
            }
        }
        
        $view = new JsonModel(array(
            'status' => $status
        ));
        return $view;
    }
    
    private function ping($host)
    {
        exec("ping -n 2 $host", $output, $status);
        if (0 == $status) {
            $status = "alive";
        } else {
            $status = "dead";
        }
        return $status;
    }
}