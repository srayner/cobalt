<?php

namespace Cobalt\Service;

class NetworkAdapterService extends AbstractEntityService
{
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
                }
            }    
        }
    }
    
}