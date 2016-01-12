<?php

namespace Cobalt\Model\LogicalDisk;

interface LogicalDiskInterface
{
    public function getLogicalDiskId();
    public function setLogicalDiskId($logicalDiskId);
    
    public function getComputerId();
    public function setComputerId($computerId);
    
    public function getDeviceId();
    public function setDeviceId($deviceId);
    
    public function getDescription();
    public function setDescription($description);
    
    public function getFileSystem();
    public function setFileSystem($fileSystem);
    
    public function getCapacity();
    public function setCapacity($capacity);
    
    public function getFreeSpace();
    public function setFreeSpace($freeSpace);
    
    public function getFreeSpaceText();
}

