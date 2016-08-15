<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;

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
                // Add raised.
                $ticket->setRaised(new \DateTime());
                
                // Add raised by
                $authService = $this->getServiceLocator()->get('CivUser\AuthService');
                $currentUserId = $authService->getIdentity()->getId();
                $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
                $currentUser = $em->getReference('Cobalt\Entity\User', $currentUserId);
                $ticket->setRaisedBy($currentUser);
                
                // Response due
                $ticket->setResponseDue(new \DateTime());
                $ticket->setResolutionDue(new \DateTime());
                
                // Persist
                $this->service->persist($ticket);
                
                // Notify requestor
                $this->service->notifySender($ticket);
                
                // Redirect.
                return $this->redirect()->toRoute('cobalt/default', array('controller' => 'ticket'));
            }
        }
        
        
        return new ViewModel(array(
            'form' => $form
        ));
    }
    
    public function editAction()
    {
        // Ensure we have an id, else redirect to add action.
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
             return $this->redirect()->toRoute('cobalt/default', array(
                 'controller' => 'ticket',
                 'action' => 'add'
             ));
        }
        
        // Grab the company with the specified id.
        $ticket = $this->service->findById($id);
        
        $form = $this->getServiceLocator()->get('Cobalt\TicketForm');
        $form->bind($ticket);
        $form->get('submit')->setAttribute('value', 'Edit');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
        
            $form->setData($request->getPost());
            if ($form->isValid()) {
                
                // Persist ticket.
            	$this->service->persist($ticket);
                
                // Redirect back to original referer
                return $this->redirect()->toUrl($this->retrieveReferer());
            
            }     
        }
        
        $this->storeReferer('ticket/edit');
        
        return new ViewModel(array(
             'id' => $id,
             'form' => $form,
        ));
    }
    
    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        $ticket = $this->service->findById($id);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            // Only perform delete if value posted was 'Yes'.
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $this->service->remove($ticket);
            
                // Redirect to ticket index
                return $this->redirect()->toRoute('cobalt/default', array(
                    'controller' => 'ticket',
                ));
            }
            
            // Redirect back to original referer
            return $this->redirect()->toUrl($this->retrieveReferer());
         }
        
        $this->storeReferer('ticket/delete');
         
        return new ViewModel(array(
            'ticket' => $ticket
        ));
    }
    
    public function detailAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        
        return new ViewModel(array(
           'ticket' => $this->service->findById($id) 
        ));
    }
    
    private function storeReferer($except)
    {
        $referer = $this->getRequest()->getHeader('Referer')->uri()->getPath();
        if (strpos($referer, $except) === false) {
            $session = new Container('ticket');
            $session->referer = $referer;
        }
    }
    
    private function retrieveReferer()
    {
        $session = new Container('ticket');
        $referer = $session->referer;
        return $referer;
    }
}