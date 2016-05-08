<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class HardwareTypeController extends AbstractController
{
    public function indexAction()
    {
        $types = $this->service->findAll();
        
        return new ViewModel(array(
            'types' => $types
        ));
    }
    
    public function addAction()
    {
        // Create a new form.
        $form = $this->getServiceLocator()->get('Cobalt\HardwareTypeForm');
         
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
          
            // Create a new company object.
            $type = $this->getServiceLocator()->get('Cobalt\HardwareType');
            
            $form->bind($type);
            $form->setData($data);
            if ($form->isValid())
            {
          	// Persist type.
            	$this->service->persist($type);
                
            	// Redirect to list of types
		return $this->redirect()->toRoute('cobalt/default', array(
		    'controller' => 'hardwaretype',
                    'action'     => 'index'
		));
            }
        } 
        
        // If not a POST request, or invalid data, then just render the form.
        return new ViewModel(array(
            'form'   => $form
        ));
    }
}