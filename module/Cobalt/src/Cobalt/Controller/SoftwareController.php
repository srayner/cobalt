<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class SoftwareController extends AbstractController
{
    public function indexAction()
    {
        return new ViewModel(array(
            'software' => $this->service->findAll()   
        ));
    }
    
    public function addAction()
    {
        // Create a new form.
        $form = $this->getServiceLocator()->get('Cobalt\SoftwareForm');
         
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
          
            // Create a new hardware object.
            $software = $this->getServiceLocator()->get('Cobalt\Software');
            
            $form->bind($software);
            $form->setData($data);
            if ($form->isValid())
            {
          	// Persist software.
                $software->setInstallationCount(0);
            	$this->service->persist($software);
                
            	// Redirect to list of software
		return $this->redirect()->toRoute('cobalt/default', array(
		    'controller' => 'software',
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
        // Get a current copy of the entity.
        $id = (int)$this->params()->fromRoute('id');
        if (!$id) {
            return $this->redirect()->toRoute('cobalt/default', array('controller' => 'software', 'action'=>'add'));
	}
        $software = $this->service->findById($id);
        
        // Create a new form instance and bind the entity to it.
        $form = $this->getServiceLocator()->get('Cobalt\SoftwareForm');
        $form->bind($software);
        
        // Check if this request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // Validate the data.
            $form->setData($request->getPost());
            if ($form->isValid())
            {
                // Save changes.
                $this->service->persist($software);

                // Redirect back to original referer.
                return $this->redirect()->toUrl($this->retrieveReferer());
            }
        }
        
        $this->storeReferer('software/edit');
        
        return new ViewModel(array(
            'id' => $id,
            'form' => $form
        ));
    }
    
    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        $software = $this->service->findById($id);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            // Only perform delete if value posted was 'Yes'.
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $this->service->remove($software);
            
                // Redirect to software index
                return $this->redirect()->toRoute('cobalt/default',
                    array('controller' => 'software'));
            }
            
            // Redirect back to original referer
            return $this->redirect()->toUrl($this->retrieveReferer());
        }
        
        $this->storeReferer('software/delete');
        
        return new ViewModel(array(
            'software' => $software
        ));
    }
    
    public function detialAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $software = $this->service->findById($id);
        
        return new ViewModel(array(
            'software' => $software
        ));
    }
    
    private function storeReferer($except)
    {
        $referer = $this->getRequest()->getHeader('Referer')->uri()->getPath();
        if (strpos($referer, $except) === false) {
            $session = new Container('software');
            $session->referer = $referer;
        }
    }
    
    private function retrieveReferer()
    {
        $session = new Container('software');
        $referer = $session->referer;
        return $referer;
    }
}