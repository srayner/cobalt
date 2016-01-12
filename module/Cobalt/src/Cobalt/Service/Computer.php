<?php

namespace Cobalt\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
        
class Computer implements ServiceManagerAwareInterface
{
    /**
     * @var ServiceManager
     */
    protected $serviceManager;
    
    /**
     * @var ComputerMapperInterface
     */
    protected $computerMapper;
    
    /**
     * @var ComputerMapperInterface
     */
    protected $logicalDiskMapper;
    
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
    
    public function setComputerMapper($mapper)
    {
        $this->computerMapper = $mapper;
        return $this;
    }
    
    public function setLogicalDiskMapper($mapper)
    {
        $this->logicalDiskMapper = $mapper;
        return $this;
    }
    
    public function getComputers()
    {
        return $this->computerMapper->getComputers();
    }
    
    public function getComputerById($computerId)
    {
        return $this->computerMapper->getComputerById($computerId);
    }
    
    public function count($search = null)
    {
        return $this->computerMapper->count($search);
    }
    
    public function getComputerByHostname($hostname)
    {
        return $this->computerMapper->getComputerByHostname($hostname);
    }
    
    public function getLogicalDisks($computerId)
    {
        return $this->logicalDiskMapper->getLogicalDisks($computerId);
    }
    
    public function deleteLogicalDisks($computerId)
    {
        return $this->logicalDiskMapper->deleteLogicalDisks($computerId);
    }
    
    public function persistComputer($computer)
    {
        $serial = $computer->getSerialNumber();
        if (!(isset($serial) === true && $serial === '')) {
            $existing = $this->computerMapper->getComputerBySerialNumber($computer->getSerialNumber());
            if ($existing) {
                $computer->setComputerId($existing->getComputerId());
                $computer->setCreated($existing->getCreated());
            }
        }
        $this->computerMapper->persist($computer);
    }
    
    public function persistLogicalDisk($logicalDisk)
    {
        $this->logicalDiskMapper->persist($logicalDisk);
    }
    
}