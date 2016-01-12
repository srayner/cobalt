<?php

namespace Cobalt\Model\Computer;

interface ComputerInterface
{
    public function getComputerId();
    public function setComputerId($computerId);
    
    public function getHostname();
    public function setHostname($hostname);
    
    public function getDomain();
    public function setDomain($domain);
    
    public function getManufacturer();
    public function setManufacturer($manufacturer);
    
    public function getModel();
    public function setModel($model);
    
    public function getSerialNumber();
    public function setSerialNumber($serialNumber);
    
    public function getBiosVersion();
    public function setBiosVersion($biosVersion);
    
    public function getSystemType();
    public function setSystemType($systemType);
    
    public function getOsName();
    public function setOsName($osName);
    
    public function getOsVersion();
    public function setOsVersion($osVersion);
    
    public function getOsBuild();
    public function setOsBuild($osBuild);
    
    public function getOsServicePack();
    public function setOsServicePack($osServicePack);
    
    public function getCreated();
    public function setCreated($created);
    
    public function getModified();
    public function setModified($created);
}

