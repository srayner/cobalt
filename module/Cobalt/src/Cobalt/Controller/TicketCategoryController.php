<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class TicketCategoryController extends AbstractController
{
    public function indexAction()
    {
        return new ViewModel(array(
            'categories' => $this->service->findAll()
        ));
    }
    
    public function addAction()
    {
        // Create a new form.
        $form = $this->getServiceLocator()->get('Cobalt\TicketCategoryForm');
         
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
          
            // Create a new hardware object.
            $category = $this->getServiceLocator()->get('Cobalt\TicketCategory');
            
            $form->bind($category);
            $form->setData($data);
            if ($form->isValid())
            {
          	// Persist ticket status.
            	$this->service->persist($category);
                
            	// Redirect to list of ticket states
		return $this->redirect()->toRoute('cobalt/default', array(
		    'controller' => 'ticketcategory',
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
                 'controller' => 'ticketcategory',
                 'action' => 'add'
             ));
        }
        
        // Grab the category with the specified id.
        $category = $this->service->findById($id);
        
        $form = $this->getServiceLocator()->get('Cobalt\TicketCategoryForm');
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
        
        $this->storeReferer('ticketcategory/edit');
        
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
            
                // Redirect to category index
                return $this->redirect()->toRoute('cobalt/default',
                    array('controller' => 'ticketcategory'));
            }
            
            // Redirect back to original referer
            return $this->redirect()->toUrl($this->retrieveReferer());
        }
        
        $this->storeReferer('ticketcategory/delete');
        
        return new ViewModel(array(
            'category' => $category
        ));
        
    }
    
    public function detailAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $category = $this->service->findById($id);
        
        // Get this history for this object.
        $historyService = $this->getServiceLocator()->get('Cobalt\HistoryService');
        $history = $historyService->find(603, $category->getID());
                
        return new ViewModel(array(
            'category' => $category,
            'history' => $history
        ));    
    }
    
    private function storeReferer($except)
    {
        $referer = $this->getRequest()->getHeader('Referer')->uri()->getPath();
        if (strpos($referer, $except) === false) {
            $session = new Container('ticketcategory');
            $session->referer = $referer;
        }
    }
    
    private function retrieveReferer()
    {
        $session = new Container('ticketcategory');
        $referer = $session->referer;
        return $referer;
    }
}