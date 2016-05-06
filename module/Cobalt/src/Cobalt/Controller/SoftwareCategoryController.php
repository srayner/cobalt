<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class SoftwareCategoryController extends AbstractController
{
    public function indexAction()
    {
        $categories = $this->service->findAll();
        
        return new ViewModel(array(
            'categories' => $categories
        ));

    }
    
    public function addAction()
    {
        // Create a new form.
        $form = $this->getServiceLocator()->get('Cobalt\SoftwareCategoryForm');
         
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
          
            // Create a new company object.
            $category = $this->getServiceLocator()->get('Cobalt\SoftwareCategory');
            
            $form->bind($category);
            $form->setData($data);
            if ($form->isValid())
            {
          	// Persist category.
            	$this->service->persist($category);
                
            	// Redirect to list of types
		return $this->redirect()->toRoute('cobalt/default', array(
		    'controller' => 'softwarecategory',
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
                 'controller' => 'softwarecategory',
                 'action' => 'add'
             ));
        }
        
        // Grab the type with the specified id.
        $category = $this->service->findById($id);
        
        $form = $this->getServiceLocator()->get('Cobalt\SoftwareCategoryForm');
        $form->bind($category);
        $form->get('submit')->setAttribute('value', 'Edit');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
        
            $form->setData($request->getPost());
            if ($form->isValid()) {
                
                // Persist category.
            	$this->service->persist($category);
                
                // Redirect to original referer
                return $this->redirect()->toUrl($this->retrieveReferer());
            }     
        }
        
        $this->storeReferer('softwarecategory/edit');
        
        return new ViewModel(array(
             'id' => $id,
             'form' => $form,
        ));
    }
    
    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        $category = $this->service->findById($id);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            // Only perform delete if value posted was 'Yes'.
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $this->service->remove($category);
            
                // Redirect to domain index
                return $this->redirect()->toRoute('cobalt/default',
                    array('controller' => 'softwarecategory'));
                }
            
            // Redirect back to original referer
            return $this->redirect()->toUrl($this->retrieveReferer());
        }
        
        $this->storeReferer('softwarecategory/edit');
        
        return new ViewModel(array(
            'category' => $category
        ));
    }
    
    public function detailAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $category = $this->service->findById($id);
        return new ViewModel(array(
            'category' => $category
        ));
    }
    
    private function storeReferer($except)
    {
        $referer = $this->getRequest()->getHeader('Referer')->uri()->getPath();
        if (strpos($referer, $except) === false) {
            $session = new Container('softwarecategory');
            $session->referer = $referer;
        }
    }
    
    private function retrieveReferer()
    {
        $session = new Container('softwarecategory');
        $referer = $session->referer;
        return $referer;
    }
}