<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;

class SoftwareLicenseController extends AbstractController
{
    public function indexAction()
    {
        $licenses = $this->service->findAll();
        
        return new ViewModel(array(
            'licenses' => $licenses
        ));
    }
    
    public function addAction()
    {
        $form = $this->getServiceLocator()->get('Cobalt\SoftwareLicenseForm');
        
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
          
            // Create a new hardware object.
            $license = $this->getServiceLocator()->get('Cobalt\SoftwareLicense');
            
            $form->bind($license);
            $form->setData($data);
            if ($form->isValid())
            {
          	// Persist license.
            	$this->service->persist($license);
                
            	// Redirect to list of license
		return $this->redirect()->toRoute('cobalt/default', array(
		    'controller' => 'softwarelicense',
                    'action'     => 'index'
		));
            }
        } 
        
        return new ViewModel(array(
            'form' => $form
        ));
    }
}