<?php

namespace Cobalt\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController
{
    protected $computerService;
    
    public function getComputerService()
    {
        if (null === $this->computerService) {
            $this->computerService = $this->getServiceLocator()->get('Cobalt\ComputerService');
        }
        return $this->computerService;
    }

    public function indexAction()
    {
        $computerService = $this->getServiceLocator()->get('Cobalt\EntityService\ComputerService');
        $projectService  = $this->getServiceLocator()->get('Project\ProjectService');
        $userService     = $this->getServiceLocator()->get('Cobalt\EntityService\UserService');
        $domainService   = $this->getServiceLocator()->get('Cobalt\EntityService\DomainService');
        
        return array(
            'computerCount' => $computerService->count(),
            'projectCount'  => $projectService->count(),
            'userCount'     => $userService->count(),
            'domainCount'   => $domainService->count(),
        );
    }
    
    public function DiskAction()
    {
        // Get credentials from config.
        $config = $this->getServiceLocator()->get('Config')['cobalt'];
        $account = $config['account'];
        $password = $config['password'];
    
        $host = $this->params()->fromRoute('id');
        $WbemLocator = new \COM("WbemScripting.SWbemLocator");
        $WbemServices = $WbemLocator->ConnectServer($host, 'root\\cimv2', $account, $password);
        $WbemServices->Security_->ImpersonationLevel = 3;
        $drives = $WbemServices->ExecQuery("Select * from Win32_LogicalDisk");
        
        // Delete existing disk info for this host.
        $service = $this->getComputerService();
        $computer = $service->getComputerByHostname($host);
        $computerId = $computer->getComputerId();
        $service->deleteLogicalDisks($computerId);
        
        // loop through scanned disks and persist each one
        foreach ($drives as $drive) {
            $logicalDisk = $this->getServiceLocator()->get('cobalt_logical_disk');
            $logicalDisk->setComputerId($computer->getComputerId())
                        ->setDeviceId($drive->DeviceId)
                        ->setDescription($drive->Description)
                        ->setFileSystem($drive->FileSystem)
                        ->setCapacity($drive->Size)
                        ->setFreeSpace($drive->FreeSpace);
            $service->persistLogicalDisk($logicalDisk);
        }
        
        // Redirect back to this host.
        $this->redirect()->toRoute('assets/default',
                array('controller' => 'index',
                      'action'     => 'host',
                      'id'         => $computerId));
    }
    
    public function ComputerAction()
    {
        // Get credentials from config.
        $config = $this->getServiceLocator()->get('Config')['cobalt'];
        $account = $config['account'];
        $password = $config['password'];
    
        $host = $this->params()->fromRoute('id');
        
        $WbemLocator = new \COM ("WbemScripting.SWbemLocator");
        $WbemServices = $WbemLocator->ConnectServer($host, 'root\\cimv2', $account, $password);
        
        
        $WbemServices->Security_->ImpersonationLevel = 3;
        
        $computerResults = $WbemServices->ExecQuery("Select * from Win32_ComputerSystem");
        $computerData = $computerResults->ItemIndex(0);       
        $biosResults = $WbemServices->ExecQuery("Select * from Win32_Bios");
        $biosData = $biosResults->itemIndex(0);
        $osResults = $WbemServices->ExecQuery("Select * from Win32_OperatingSystem");
        $osData = $osResults->itemIndex(0);
        
        $computer = $this->getServiceLocator()->get('cobalt_computer');
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
                
        $service = $this->getComputerService();
        $service->persistComputer($computer);
        
        return array(
            'computer' => $computerData
        );  
    }
    
    public function OsAction()
    {
        // Get credentials from config.
        $config = $this->getServiceLocator()->get('Config')['cobalt'];
        $account = $config['account'];
        $password = $config['password'];
    
        $host = $this->params()->fromRoute('id');
        $WbemLocator = new \COM("WbemScripting.SWbemLocator");
        $WbemServices = $WbemLocator->ConnectServer($host, 'root\\cimv2', $account, $password);
        $WbemServices->Security_->ImpersonationLevel = 3;
        $os = $WbemServices->ExecQuery("Select * from Win32_OperatingSystem");
        
        return array(
            'os' => $os->ItemIndex(0)
        );  
        
    }
    
    public function BiosAction()
    {
        // Get credentials from config.
        $config = $this->getServiceLocator()->get('Config')['cobalt'];
        $account = $config['account'];
        $password = $config['password'];
    
        $host = $config['test_host']; // hostname or IP address
        $WbemLocator = new \COM ("WbemScripting.SWbemLocator");
        $WbemServices = $WbemLocator->ConnectServer($host, 'root\\cimv2', $account, $password);
        $WbemServices->Security_->ImpersonationLevel = 3;
        $computers = $WbemServices->ExecQuery("Select * from Win32_Bios");
       
        return array(
            'computer' => $computers->ItemIndex(0)
        );  
    }
    
    public function MemoryAction()
    {
        // Get credentials from config.
        $config = $this->getServiceLocator()->get('Config')['cobalt'];
        $account = $config['account'];
        $password = $config['password'];
    
        $host = $config['test_host']; // hostname or IP address
        $WbemLocator = new \COM ("WbemScripting.SWbemLocator");
        $WbemServices = $WbemLocator->ConnectServer($host, 'root\\cimv2', $account, $password);
        $WbemServices->Security_->ImpersonationLevel = 3;
        $memory = $WbemServices->ExecQuery("Select * from Win32_PhysicalMemory");
       
        return array(
            'memory' => $memory
        );  
    }
    
     public function AdapterAction()
    {
        // Get credentials from config.
        $config = $this->getServiceLocator()->get('Config')['cobalt'];
        $account = $config['account'];
        $password = $config['password'];
    
        $host = $config['test_host']; // hostname or IP address
        $WbemLocator = new \COM ("WbemScripting.SWbemLocator");
        $WbemServices = $WbemLocator->ConnectServer($host, 'root\\cimv2', $account, $password);
        $WbemServices->Security_->ImpersonationLevel = 3;
        $adapter = $WbemServices->ExecQuery("Select * from Win32_NetworkAdapterConfiguration");
        
        return array(
            'adapter' => $adapter
        );  
    }
    
    public function pingAction()
    {
        $host = $this->params()->fromRoute('id');
        $up = $this->ping($host);
        return array('status' => $up);
    }
    
    
    private function ping($host)
    {
        exec("ping -n 1 $host", $output, $result);
        if ($result == 0){
            return TRUE;
        } else {
           return FALSE;
        }
    }
    
    public function fileAction()
    {
        // Get credentials from config.
        $config = $this->getServiceLocator()->get('Config')['cobalt'];
        $file = $config['test_log'];
        $service = $this->serviceLocator->get('cobalt_activity_service');
        $service->processFile($file);        
    }
    
    public function filesAction()
    {
        $config = $this->getServiceLocator()->get('Config')['cobalt'];
        $dir = $config['activity_log_path'];
        $service = $this->serviceLocator->get('cobalt_activity_service');
        $service->processFiles($dir);   
    }
    
    public function warrantyAction()
    {
        
        $tag = $this->params()->fromRoute('id');
        $url = 'https://sandbox.api.dell.com/support/v2/assetinfo/warranty/tags.xml?svctags=' . $tag . '&apikey=' . $config['dell_api_key'];
        $proxy = $config['web_proxy'];
        
        try
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_PROXY, $proxy);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $xml = curl_exec($ch);
            
            if (FALSE === $xml)
                throw new \Exception(curl_error($ch), curl_errno($ch));
            
            $dom = new \DOMDocument;
            $dom->loadXML($xml);
            $warranty = $dom->getElementsByTagNameNS('http://schemas.datacontract.org/2004/07/Dell.AWR.Domain.Asset', 'Warranty')->item(0);
            $result = array();
            $result['service_tag'] = $tag;
            foreach ($warranty->childNodes as $property) {
              
                if ($property->localName == 'ServiceLevelDescription') {
                    $result['ServiceLevelDescription'] = $property->nodeValue;
                }
                if ($property->localName == 'StartDate') {
                    $result['warranty_start'] = $property->nodeValue;
                }
                if ($property->localName == 'EndDate') {
                    $result['warranty_end'] = $property->nodeValue;
                }
                
            }
            return $result;
          
        } catch (Exception $ex) {
            trigger_error(sprintf('Curl failed with error #%d: %s', $e->getCode(), $e->getMessage()),E_USER_ERROR);
        }
    }
    
    public function groupAction()
    {
        $adService = $this->getServiceLocator()->get('Cobalt\ActiveDirectoryService');
        $adService->getGroups();
    
        die('still ok');
        
        return array();
    }
    
}
