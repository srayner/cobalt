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
        // Check we have a company id, if not redirect back to list of companies.
        $id = (int)$this->params()->fromRoute('id');
        if (!$id) {
            return $this->redirect()->toRoute('cobalt/default', array('controller' => 'company'));
	}
        
        // Create a new form.
        $form = $this->getServiceLocator()->get('Cobalt\OfficeForm');
         
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            $office = $this->getServiceLocator()->get('Cobalt\Office');
            $form->bind($office);
            $form->setData($request->getPost());
            if ($form->isValid())
            {
                // Persist office
          	$em = $this->service->getEntityManager();
                $office->setCompany($em->getReference('Cobalt\Entity\Company', $id));
                $this->service->persist($office);
                
            	// Redirect.
                return $this->redirect()->toRoute('cobalt/default',
                    array('controller' => 'company',
                          'action' => 'detail',
                          'id' => $id
		    ),
                    array('fragment' => 'offices')
                );
            }
        } 
        
        // If not a POST request, or invalid data, then just render the form.
        return new ViewModel(array(
            'form'   => $form,
            'companyId' => $id
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
