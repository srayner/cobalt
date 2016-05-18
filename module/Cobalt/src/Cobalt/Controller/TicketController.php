<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;

class TicketController extends AbstractController
{
    public function indexAction()
    {
        $tickets = $this->service->findAll();
        
        return new ViewModel(array(
            'tickets' => $tickets
        ));
    }
    
    public function addAction()
    {
        $form = $this->getServiceLocator()->get('Cobalt\TicketForm');
        
        $request = $this->getRequest();
        
        if ($request->isPost())
        {
            $ticket = $this->getServiceLocator()->get('Cobalt\Ticket');
            $form->bind($ticket);
            $form->setData($request->getPost());
            if ($form->isValid())
            {
                // TODO: Add raised by
                
                // Persist
            //    $this->service->persist($ticket);
                
                // Redirect.
                return $this->redirect()->toRoute('cobalt/default', array('controller' => 'ticket'));
            }
        }
        
        
        return new ViewModel(array(
            'form' => $form
        ));
    }
}