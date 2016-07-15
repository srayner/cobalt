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
    
    public function readEventLogs($host, $domain, $service)
    {
        // Get credentials.
        $account = $this->options['account'];
        $password = $this->options['password'];
        
        $WbemLocator = new \COM("WbemScripting.SWbemLocator");
        $WbemServices = $WbemLocator->ConnectServer($host, 'root\\cimv2', $account, $password);
        $WbemServices->Security_->ImpersonationLevel = 3;
        $events = $WbemServices->ExecQuery("Select * from Win32_NTLogEvent Where Logfile = 'System' and type = 'Error' and TimeWritten > '2016'");
        
        foreach($events as $event) {
            echo $event->category . '<br>';
            echo $event->computerName . '<br>';
            echo $event->eventCode . '<br>';
            echo $event->message . '<br>';
            echo $event->recordNumber . '<br>';
            echo $event->sourceName . '<br>';
            echo $event->timeWritten . '<br>';
            echo $event->type . '<br>';
            echo $event->user . '<br>';
            echo '<hr>';
        }
        die();
            
        
 /**   Wscript.Echo "Category: " & objEvent.Category & VBNewLine _
    & "Computer Name: " & objEvent.ComputerName & VBNewLine _
    & "Event Code: " & objEvent.EventCode & VBNewLine _
    & "Message: " & objEvent.Message & VBNewLine _
    & "Record Number: " & objEvent.RecordNumber & VBNewLine _
    & "Source Name: " & objEvent.SourceName & VBNewLine _
    & "Time Written: " & objEvent.TimeWritten & VBNewLine _
    & "Event Type: " & objEvent.Type & VBNewLine _
    & "User: " & objEvent.User
Next
  * 
  */
        die('ok');
    }
}

