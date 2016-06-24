<?php

namespace Cobalt\Service;

use Cobalt\Entity\Computer;

class WMI
{
    protected $options;
    
    public function setOptions($options)
    {
        $this->options = $options;
    }
    
    public function ScanComputer($host, $domain, $service)
    {
        // Get credentials.
        $account = $this->options['account'];
        $password = $this->options['password'];
        
        $WbemLocator = new \COM ("WbemScripting.SWbemLocator");
        $WbemServices = $WbemLocator->ConnectServer($host, 'root\\cimv2', $account, $password);
        $WbemServices->Security_->ImpersonationLevel = 3;
        
        $computerResults = $WbemServices->ExecQuery("Select * from Win32_ComputerSystem");
        $computerData = $computerResults->ItemIndex(0);       
        $biosResults = $WbemServices->ExecQuery("Select * from Win32_Bios");
        $biosData = $biosResults->itemIndex(0);
        $osResults = $WbemServices->ExecQuery("Select * from Win32_OperatingSystem");
        $osData = $osResults->itemIndex(0);
        
        //if ($biosData->SerialNumber != '') {
        //    $computer = $service->findBySerial($biosData->SerialNumber);
        //} else {
        //    $computer = $service->findBySerial($host);
        //}
        //if (!$computer) {
        //    $computer = new Computer;
        //}
        
        $computer = $service->findByDNSName($host, $domain);
        
        $computer->setHostname($host);
        $computer->setDomain($computerData->Domain);
        $computer->setManufacturer($computerData->Manufacturer);
        $computer->setModel($computerData->Model);
        $computer->setSerialNumber($biosData->SerialNumber);
        $computer->setBiosVersion($biosData->SMBIOSBIOSVersion);
        $computer->setSystemType($computerData->SystemType);
        $computer->setOsName(strstr($osData->Name, "|", true));
        $computer->setOsVersion($osData->Version);
        $computer->setOsBuild($osData->BuildNumber);
        $computer->setOsServicePack($osData->ServicePackMajorVersion);
                
        $service->persist($computer);
        
    }
}

