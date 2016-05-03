<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;

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
        // Get a current copy of the entity.
        $id = (int)$this->params()->fromRoute('id');
        if (!$id) {
            return $this->redirect()->toRoute('cobalt/default', array('controller' => 'office', 'action'=>'add'));
	}
        $office = $this->service->findById($id);
        
        // Create a new form instance and bind the entity to it.
        $form = $this->getServiceLocator()->get('Cobalt\OfficeForm');
        $form->bind($office);
        
        // Check if this request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // Validate the data.
            $form->setData($request->getPost());
            if ($form->isValid())
            {
                // Save changes.
                $this->service->persist($office);

                // Redirect back to original referer.
                return $this->redirect()->toUrl($this->retrieveReferer());
            }
        }
        
        $this->storeReferer('milestone/edit');
        
        return new ViewModel(array(
            'id' => $id,
            'form' => $form
        ));
        
    }
    
    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        $office = $this->service->findById($id);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            $companyId = $office->getCompany()->getId();
            
            // Only perform delete if value posted was 'Yes'.
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $this->service->remove($office);
            }

            // Redirect to company detail
            return $this->redirect()->toRoute('cobalt/default',
                array(
                    'controller' => 'company',
                    'action' => 'detail',
                    'id' => $companyId),
                array('fragment' => 'offices')
            );
         }
         
        return new ViewModel(array(
            'office' => $office
        ));
    }
    
    public function detailAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $office = $this->service->findById($id);
        return new ViewModel(array(
            'office' => $office
        ));
    }
    
    private function storeReferer($except)
    {
        $referer = $this->getRequest()->getHeader('Referer')->uri()->getPath();
        if (strpos($referer, $except) === false) {
            $session = new Container('office');
            $session->referer = $referer;
        }
    }
    
    private function retrieveReferer()
    {
        $session = new Container('office');
        $referer = $session->referer;
        if (strpos($referer, 'company/detail') !== false) {
            $referer .= '#offices';
        }
        return $referer;
    }
}
