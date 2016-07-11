<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;

class ConsumableController extends AbstractController
{
    public function indexAction()
    {
        $consumables = $this->service->findAll();
        
        return new ViewModel(array(
            'consumables' => $consumables
        ));
    }
    
    public function addAction()
    {
        // Create a new form.
        $form = $this->getServiceLocator()->get('Cobalt\ConsumableForm');
         
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
          
            // Create a new company object.
            $consumable = $this->getServiceLocator()->get('Cobalt\Consumable');
            
            $form->bind($consumable);
            $form->setData($data);
            if ($form->isValid())
            {
          	// Persist consumable.
            	$this->service->persist($consumable);
                
            	// Redirect to list of consumables
		return $this->redirect()->toRoute('cobalt/default', array(
		    'controller' => 'consumable',
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
                 'controller' => 'consumable',
                 'action' => 'add'
             ));
        }
        
        // Grab the consumable with the specified id.
        $consumable = $this->service->findById($id);
        
        $form = $this->getServiceLocator()->get('Cobalt\ConsumableForm');
        $form->bind($consumable);
        $form->get('submit')->setAttribute('value', 'Edit');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
        
            $form->setData($request->getPost());
            if ($form->isValid()) {
                
                // Persist consumable.
            	$this->service->persist($company);
                
                // Redirect to list of consumables
                return $this->redirect()->toRoute('cobalt/default', array(
                    'controller' => 'consumable'
                ));
            }     
        }
        
        return new ViewModel(array(
             'id' => $id,
             'form' => $form,
        ));
    }
    
    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        $consumable = $this->service->findById($id);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            // Only perform delete if value posted was 'Yes'.
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $this->service->remove($consumable);
            }

            // Redirect to domain index
            return $this->redirect()->toRoute('cobalt/default',
                array('controller' => 'consumable'));
         }
         
        return new ViewModel(array(
            'consumable' => $consumable
        ));
    }
    
    public function detailAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $consumable = $this->service->findById($id);
        return new ViewModel(array(
            'consumable' => $consumable
        ));
    }
}