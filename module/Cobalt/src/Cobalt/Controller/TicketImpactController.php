<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;

class TicketImpactController extends AbstractController
{
    public function indexAction()
    {
        return new ViewModel(array(
            'impacts' => $this->service->findAll()
        ));
    }
    
    public function addAction()
    {
        // Create a new form.
        $form = $this->getServiceLocator()->get('Cobalt\TicketImpactForm');
         
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
          
            // Create a new hardware object.
            $impact = $this->getServiceLocator()->get('Cobalt\TicketImpact');
            
            $form->bind($impact);
            $form->setData($data);
            if ($form->isValid())
            {
          	// Persist ticket impact.
            	$this->service->persist($impact);
                
            	// Redirect to list of ticket states
		return $this->redirect()->toRoute('cobalt/default', array(
		    'controller' => 'ticketimpact',
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