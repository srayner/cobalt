<?php

namespace Cobalt\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
        
class Activity implements ServiceManagerAwareInterface
{
    /**
     * @var ServiceManager
     */
    protected $serviceManager;
    
    /**
     * @var ComputerMapperInterface
     */
    protected $activityMapper;

    protected $logPath;
    
    public function setLogPath($path)
    {
        $this->logPath = $path;
    }
    
    /**
     * Retrieve service manager instance
     *
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }
    
    /**
     * Set service manager instance
     *
     * @param ServiceManager $serviceManager
     * @return Computer
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }
    
    public function setActivityMapper($mapper)
    {
        $this->activityMapper = $mapper;
        return $this;
    }
    
    public function getActivityForHost($hostname)
    {
        return $this->activityMapper->getActivityForHost($hostname);
    }
    
    public function getActivityForUser($username)
    {
        return $this->activityMapper->getActivityForUser($username);
    }
    
    public function persistActivity($activity)
    {
        $this->activityMapper->persistActivity($activity);
        return $this;
    }
    
    public function processFiles($dir)
    {
        $files = new \DirectoryIterator($dir);
        foreach ($files as $fileinfo) {
            if (!$fileinfo->isDot()) {
                if (strtolower($fileinfo->getExtension()) == 'log'){
                    $this->processFile($fileinfo->getFilename());
                }
            }
        }
    }
    
    private function processFile($file)
    {
        $path = $this->path;
        $properties = array();
        
        $file_handle = fopen($path . $file, "r");
        while (!feof($file_handle)) {
          $line = fgets($file_handle);
          $i = strpos($line, ':');#
          $key = trim(substr($line, 0, $i));
          $value = trim(substr($line, $i+1));
          $properties[$key] = $value;
          
        }
        fclose($file_handle);
        $properties['Date'] = new \DateTime();
        $properties['Date']->setTimestamp(filemtime($path . $file));
        
        $activity = new \Cobalt\Model\Activity\Activity();
        $activity->setActivityTime($properties['Date'])
                 ->setActivityType('Windows Logon')
                 ->setHostname(strtolower($properties['Host Name']))
                 ->setUsername(strtolower($properties['User Name']));
        $this->persistActivity($activity);
    }
}