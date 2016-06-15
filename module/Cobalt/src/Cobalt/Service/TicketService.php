<?php

namespace Cobalt\Service;

class TicketService extends AbstractEntityService
{
    protected $notificationService;
    protected $mailService;
    protected $mailConfig;
    
    public function count()
    {
        return $this->entityManager
                    ->createQuery('SELECT COUNT(t.id) FROM Cobalt\Entity\Ticket t')
                    ->getSingleScalarResult();
    }
    
    public function countOpen()
    {
        return $this->entityManager
                    ->createQuery('SELECT COUNT(t.id) FROM Cobalt\Entity\Ticket t WHERE t.status_id <> 2')
                    ->getSingleScalarResult();
    }
    
    public function __construct($entityManager, $repository, $notificationService, $mailService, $mailConfig)
    {
        parent::__construct($entityManager, $repository);
        $this->notificationService = $notificationService;
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
        $this->mailService->addContent($mail, 'text/html', $this->renderTemplate($ticket));
        $this->mailService->persist($mail);
    }
    
    // Returns a template of the given name.
    // This can be refactored later.
    private function getTemplate($name)
    {
        $notification =  $this->notificationService->findByName($name);
        return $notification->getTemplate();
    }
    
    private function renderTemplate($ticket)
    {
        $loader = new \Twig_Loader_Array(array(
            'new_ticket' => $this->getTemplate('requestor_new_ticket')
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