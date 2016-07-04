<?php

namespace Cobalt\Service;

class WMI
{
    protected $options;
    protected $serviceLocator;
    
    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }
    
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
    //    $computer->setManufacturer($computerData->Manufacturer);
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
    
    public function scanLogicalDisks($host, $domain, $service)
    {
        // Get credentials.
        $account = $this->options['account'];
        $password = $this->options['password'];
        
        $WbemLocator = new \COM("WbemScripting.SWbemLocator");
        $WbemServices = $WbemLocator->ConnectServer($host, 'root\\cimv2', $account, $password);
        $WbemServices->Security_->ImpersonationLevel = 3;
        $disks = $WbemServices->ExecQuery("Select * from Win32_LogicalDisk");
        
    
        // Delete existing disk info for this host.
        $computer = $service->findByDNSName($host, $domain);
        $computer->clearLogicalDisks();
        
        
        // loop through scanned disks and persist each one
        foreach ($disks as $disk) {
            var_dump($disk);
            $logicalDisk = $this->serviceLocator->get('Cobalt\LogicalDisk');
            $logicalDisk->setDeviceId($disk->DeviceId)
                        ->setDescription($disk->Description)
                        ->setFileSystem($disk->FileSystem)
                        ->setCapacity($disk->Size)
                        ->setFreeSpace($disk->FreeSpace);
            $computer->addLogicalDisk($logicalDisk);
        }
        
        $service->persist($computer);
    }
}

