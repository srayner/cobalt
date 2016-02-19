<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;

class DomainController extends AbstractController
{
    public function indexAction()
    {
        return new ViewModel(array(
            'domains' => $this->service->findAll()
        ));
    }
    
    public function addAction()
    {
        // Create new form and hydrator instances.
        $form = $this->getServiceLocator()->get('Cobalt\DomainForm');
         
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
          
            // Create a new domain object.
            $domain = $this->getServiceLocator()->get('Cobalt\Domain');
            
            $form->bind($domain);
            $form->setData($data);
            if ($form->isValid())
            {
          	// Persist domain.
            	$this->service->persist($domain);
                
            	// Redirect to list of domains
		return $this->redirect()->toRoute('cobalt/default', array(
                    'controller' =>'domain'
		));
            }
        } 
        
        // If not a POST request, or invalid data, then just render the form.
        return new ViewModel(array(
            'form'   => $form,
        ));
    }
}
