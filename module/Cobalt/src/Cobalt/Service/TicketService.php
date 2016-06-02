<?php

namespace Cobalt\Service;

class TicketService extends AbstractEntityService
{
    protected $mailService;
    protected $mailConfig;
    
    public function __construct($entityManager, $repository, $mailService, $mailConfig)
    {
        parent::__construct($entityManager, $repository);
        $this->mailService = $mailService;
        $this->mailConfig = $mailConfig;
    }
    
    public function notifySender($ticket)
    {
        // To
        $to = $ticket->getRequestor();
        
        // From (and reply)
        $fromAddress = $this->mailConfig['email_address'];
        $fromName = $this->mailConfig['email_name'];
        
        // Create email.
        $mail = $this->mailService->createMail('Support Ticket Raised', $fromName, $fromAddress);
        $this->mailService->addParticipant($mail, 'to', $to->getDisplayName(), $to->getEmailAddress());
        $this->mailService->addParticipant($mail, 'from', $fromName, $fromAddress);
        $this->mailService->addContent($mail, 'text/plain', $this->renderTemplate($ticket));
        $this->mailService->persist($mail);
    }
    
    // Returns a template of the given name.
    // This can be refactored later.
    private function getTemplate($name)
    {
        return file_get_contents("data\\templates\\$name");
    }
    
    private function renderTemplate($ticket)
    {
        $loader = new \Twig_Loader_Array(array(
            'new_ticket' => $this->getTemplate('new_ticket')
        ));
        $environment = new \Twig_Environment($loader);
        $txt = $environment->render('new_ticket', array(
            'RequesterDisplayName'  => $ticket->getRequestor()->getDisplayName(),
            'TechnicianDisplayName' => $ticket->getTechnician()->getDisplayName(),
            'TicketId'              => $ticket->getId(),
            'TicketSubject'         => $ticket->getSubject(),
            'TicketStatus'          => $ticket->getStatus()->getName(),
            'TicketPriority'        => $ticket->getPriority()->getName(),
            'TicketProblem'         => $ticket->getProblem(),
            'TicketResolutionDue'   => $ticket->getResolutionDue()->format('d/m/Y'),
        ));
        return $txt;
    }
    
}