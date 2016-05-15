<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;

class SoftwareController extends AbstractController
{
    public function indexAction()
    {
        return new ViewModel(array(
            
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
        return new ViewModel(array(
            
        ));
    }
    
    public function deleteAction()
    {
        return new ViewModel(array(
            
        ));
    }
    
    public function detialAction()
    {
        return new ViewModel(array(
            
        ));
    }
}