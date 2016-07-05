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
        echo 'ok';
    }
    
}