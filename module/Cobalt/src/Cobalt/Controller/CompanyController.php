<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;

class CompanyController extends AbstractController
{
    public function indexAction()
    {
        $companies = $this->service->findAll();
        
        return new ViewModel(array(
            'companies' => $companies
        ));
    }
    
    public function addAction()
    {
        // Create a new form.
        $form = $this->getServiceLocator()->get('Cobalt\CompanyForm');
         
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
          
            // Create a new company object.
            $company = $this->getServiceLocator()->get('Cobalt\Company');
            
            $form->bind($company);
            $form->setData($data);
            if ($form->isValid())
            {
          	// Persist company.
            	$this->service->persist($company);
                
            	// Redirect to list of computers
		return $this->redirect()->toRoute('cobalt/default', array(
		    'controller' => 'company',
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
                 'controller' => 'company',
                 'action' => 'add'
             ));
        }
        
        // Grab the company with the specified id.
        $company = $this->service->findById($id);
        
        $form = $this->getServiceLocator()->get('Cobalt\CompanyForm');
        $form->bind($company);
        $form->get('submit')->setAttribute('value', 'Edit');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
        
            $form->setData($request->getPost());
            if ($form->isValid()) {
                
                // Persist company.
            	$this->service->persist($company);
                
                // Redirect to list of companies
                return $this->redirect()->toRoute('cobalt/default', array(
                    'controller' => 'company'
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
        $company = $this->service->findById($id);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            // Only perform delete if value posted was 'Yes'.
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $this->service->remove($company);
            }

            // Redirect to domain index
            return $this->redirect()->toRoute('cobalt/default',
                array('controller' => 'company'));
         }
         
        return new ViewModel(array(
            'company' => $company
        ));
    }
    
    public function detailAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $company = $this->service->findById($id);
        return new ViewModel(array(
            'company' => $company
        ));
    }
}
