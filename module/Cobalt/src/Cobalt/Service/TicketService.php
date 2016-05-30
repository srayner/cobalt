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
        $mail = $this->mailService->createMail('Support Ticket Raised', $fromAddress, $fromName);
        $this->mailService->addParticipant($mail, 'to', $to->getEmailAddress(), $to->getDisplayName());
        $this->mailService->addParticipant($mail, 'from', $fromAddress, $fromName);
        $this->mailService->addContent($mail, 'text/plain', 'A new support ticket has been raised.');
        $this->mailService->persist($mail);
    }
    
}