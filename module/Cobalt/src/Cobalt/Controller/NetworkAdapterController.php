<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;

class NetworkAdapterController extends AbstractController
{
    public function addAction()
    {
        // Check we have a company id, if not redirect back to list of companies.
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
        
    }
    
    public function deleteAction()
    {
        
    }
}
    