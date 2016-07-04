<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;

class NetworkAdapterController extends AbstractController
{
    public function addAction()
    {
        // Check we have a company id, if not redirect back to list of hardware.
        $hardwareId = (int)$this->params()->fromRoute('id');
        if (!$hardwareId) {
            return $this->redirect()->toRoute('cobalt/default', array('controller' => 'hardware'));
	}
        
        // Create a new form.
        $form = $this->getServiceLocator()->get('Cobalt\NetworkAdapterForm');
         
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
          
            // Create a new network adapter object.
            $adapter = $this->getServiceLocator()->get('Cobalt\NetworkAdapter');
            
            $form->bind($adapter);
            $form->setData($data);
            if ($form->isValid())
            {
          	// Persist adapter.
            	$hardware = $this->service->getReference('Cobalt\Entity\Hardware', $hardwareId);
                $adapter->setHardware($hardware);
                $this->service->persist($adapter);
                
                
            	// Redirect to hardware detail
		return $this->redirect()->toRoute('cobalt/default', array(
		    'controller' => 'hardware',
                    'action'     => 'detail',
                    'id' => $hardwareId
		));
            }
        } 
        
        // If not a POST request, or invalid data, then just render the form.
        return new ViewModel(array(
            'form'   => $form,
            'hardwareId' => $hardwareId
        ));
        
    }
    
    public function editAction()
    {
        // Ensure we have an id, else redirect to list of hardware.
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
             return $this->redirect()->toRoute('cobalt/default', array('controller' => 'hardware'));
        }
        
        // Grab the adapter with the specified id.
        $adapter = $this->service->findById($id);
        
        $form = $this->getServiceLocator()->get('Cobalt\NetworkAdapterForm');
        $form->bind($adapter);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
        
            $form->setData($request->getPost());
            if ($form->isValid()) {
                
                // Persist adapter.
            	$this->service->persist($adapter);
                
                // Redirect to hardware detail page.
                return $this->redirect()->toRoute('cobalt/default', array(
                    'controller' => 'hardware',
                    'action'     => 'detail',
                    'id'         => $adapter->getHardware()->getId()
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
        
    }
    
    public function monitorAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        $monitor = ('true' == $this->params()->fromPost('monitor'));
        
        $adapter = $this->service->findById($id);
        $adapter->setMonitor($monitor);
        $this->service->persist($adapter);
        
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent("Ok.");
        return $response;
    }
}
    