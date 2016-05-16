<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;

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
    
    public function editAction()
    {
        
        // Get a current copy of the entity.
        $id = (int)$this->params()->fromRoute('id');
        if (!$id) {
            return $this->redirect()->toRoute('cobalt/default', array('controller' => 'softwarelicense', 'action'=>'add'));
	}
        $license = $this->service->findById($id);
        
        // Create a new form instance and bind the entity to it.
        $form = $this->getServiceLocator()->get('Cobalt\SoftwareLicenseForm');
        $form->bind($license);
        
        // Check if this request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // Validate the data.
            $form->setData($request->getPost());
            if ($form->isValid())
            {
                // Save changes.
                $this->service->persist($license);

                // Redirect back to original referer.
                return $this->redirect()->toUrl($this->retrieveReferer());
            }
        }
        
        $this->storeReferer('softwarelicense/edit');
        
        return new ViewModel(array(
            'id' => $id,
            'form' => $form
        ));
    }
    
    private function storeReferer($except)
    {
        $referer = $this->getRequest()->getHeader('Referer')->uri()->getPath();
        if (strpos($referer, $except) === false) {
            $session = new Container('softwarelicense');
            $session->referer = $referer;
        }
    }
    
    private function retrieveReferer()
    {
        $session = new Container('softwarelicense');
        $referer = $session->referer;
        if (strpos($referer, 'software/detail') !== false) {
            $referer .= '#licenses';
        }
        return $referer;
    }
}