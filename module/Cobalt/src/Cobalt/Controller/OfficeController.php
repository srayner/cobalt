<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;

class OfficeController extends AbstractController
{
    public function indexAction()
    {
        $offices = $this->service->findAll();
        
        return array(
            'offices' => $offices
        );
    }
    
    public function addAction()
    {
        // Create a new form.
        $form = $this->getServiceLocator()->get('Cobalt\OfficeForm');
         
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
          
            // Create a new office object.
            $office = $this->getServiceLocator()->get('Cobalt\Office');
            
            $form->bind($office);
            $form->setData($data);
            if ($form->isValid())
            {
          	// Persist office.
            	$this->service->persist($office);
                
            	// Redirect to list of offices
		return $this->redirect()->toRoute('cobalt/default', array(
		    'controller' => 'office',
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
        
    }
    
    public function deleteAction()
    {
        
    }
    
    public function detailAction()
    {
        
    }
}
