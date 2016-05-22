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
                
                // Redirect.
                return $this->redirect()->toRoute('cobalt/default', array('controller' => 'ticket'));
            }
        }
        
        
        return new ViewModel(array(
            'form' => $form
        ));
    }
}