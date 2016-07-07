<?php

namespace Cobalt\Service;

use DateTime;

class NetworkAdapterService extends AbstractEntityService
{
    protected $notificationService;
    protected $mailService;
    protected $mailConfig;
    
    public function __construct($entityManager, $repository, $notificationService, $mailService, $mailConfig)
    {
        parent::__construct($entityManager, $repository);
        $this->notificationService = $notificationService;
        $this->mailService = $mailService;
        $this->mailConfig = $mailConfig;
    }
    
    public function pingAndUpdate($id)
    {
        $adapter = $this->findById($id);
        if ($adapter->getIpv4())
        {
            $host = $adapter->getIpv4();
            $status = $this->ping($host);
            if ($status == 'alive') {
                $adapter->getHardware()->setLastSeen(New Date);
            }
        }
    }
    
    private function ping($host)
    {
        exec("ping -n 1 -w 1000 $host", $output, $status);
        if (0 == $status) {
            $status = "alive";
        } else {
            $status = "dead";
        }
        return $status;
    }
    
    public function monitor()
    {
        // get list of adapters we are monitoring
        $adapters = $this->entityManager->getRepository($this->repository)->findBy(array(
            'monitor' => true
        ));
        
        // loop through adapters
        foreach($adapters as $adapter) {
            
            if ($adapter->getIpv4Address()) {
                
                // ping adapter
                $status = $this->ping($adapter->getIpv4Address());
                
                // check for status change
                if ($adapter->getStatus() != $status) {
                    
                    // store new status
                    $adapter->setStatus($status);
                    $this->persist($adapter);
                    
                    // raise an event
                    $params = array(
                        'id' => $adapter->getId(),
                        'status', $status
                    );
                    $this->getEventManager()->trigger('network_adapter_status.post', $this, $params);
                    
                    // TODO: refactor this later
                    $this->notifyAdmin($adapter);
                }
            }    
        }
    }
    
    public function notifyAdmin($adapter)
    {   
        // From (and reply)
        $fromAddress = $this->mailConfig['email_address'];
        $fromName = $this->mailConfig['email_name'];
        
        // Create email.
        $mail = $this->mailService->createMail('Monitored hardware status changed', $fromName, $fromAddress);
        $this->mailService->addParticipant($mail, 'from', $fromName, $fromAddress);
        
        // To
        $admins = $this->entityManager->getRepository('Cobalt\Entity\User')->findAdmins();
        foreach($admins as $admin) {
            $this->mailService->addParticipant($mail, 'to', $admin->getDisplayName(), $admin->getEmailAddress());
        }
        
        // Add Content and persist.
        $this->mailService->addContent($mail, 'text/html', $this->renderTemplate($adapter));
        $this->mailService->persist($mail);
    }
    
    // Returns a template of the given name.
    // This can be refactored later.
    private function getTemplate($name)
    {
        $notification =  $this->notificationService->findByName($name);
        return $notification->getTemplate();
    }
    
    private function renderTemplate($adapter)
    {
        $dateTime = new DateTime();
        $loader = new \Twig_Loader_Array(array(
            'hardware_status_change' => $this->getTemplate('hardware_status_change')
        ));
        $environment = new \Twig_Environment($loader);
        $txt = $environment->render('hardware_status_change', array(
            'HardwareName' => $adapter->getHardware()->getName(),
            'AdapterName'  => $adapter->getName(),
            'Ipv4Address'  => $adapter->getIpv4Address(),
            'Status'       => $adapter->getStatus(),
            'DateTime'     => $dateTime->format('d/m/Y'),
        ));
        return $txt;
    }
    
}