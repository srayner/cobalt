<?php

namespace Cobalt\Model\LogicalDisk;
    
class LogicalDisk implements LogicalDiskInterface
{
    protected $logicalDiskId;
    protected $computerId;
    protected $deviceId;
    protected $description;
    protected $fileSystem;
    protected $capacity;
    protected $freeSpace;
    
    public function getLogicalDiskId()
    {
        return $this->logicalDiskId;
    }
    
    public function setLogicalDiskId($logicalDiskId)
    {
        $this->logicalDiskId = $logicalDiskId;
        return $this;
    }
    
    public function getComputerId()
    {
        return $this->computerId;
    }
    
    public function setComputerId($computerId)
    {
        $this->computerId = $computerId;
        return $this;
    }
    
    public function getDeviceId()
    {
        return $this->deviceId;
    }
    
    public function setDeviceId($deviceId)
    {
        $this->deviceId = $deviceId;
        return $this;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    
    public function getFileSystem()
    {
        return $this->fileSystem;
    }
    
    public function setFileSystem($fileSystem)
    {
        $this->fileSystem = $fileSystem;
        return $this;
    }
    
    public function getCapacity()
    {
        return $this->capacity;
    }
    
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
        return $this;
    }
    
    public function getFreeSpace()
    {
        return $this->freeSpace;
    }
    
    public function setFreeSpace($freeSpace)
    {
        $this->freeSpace = $freeSpace;
        return $this;
    }
    
    public function getFreeSpaceText()
    {
        if ($this->capacity == 0)
        {
            return '';
        }
        else
        {
            $value = ($this->freeSpace / $this->capacity)*100;
            return round($value, 0, PHP_ROUND_HALF_UP);
            
        }
    }
    
    public function getFreeSpacePercent()
    {
        if ($this->capacity == 0)
        {
            return null;
        }
        else
        {
            return ($this->freeSpace / $this->capacity)*100;
            
        }
    }
    
    public function getFreeSpaceClass()
    {
        
        $free = $this->getFreeSpacePercent();
        
            $result = 'progress-bar-success';
            if ($free < 33) {
                $result = 'progress-bar-warning';
            }
            if ($free < 25) {
                $result = 'progress-bar-danger';
            }
        
        
        return $result;
    }
}
