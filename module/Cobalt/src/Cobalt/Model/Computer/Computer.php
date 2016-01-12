<?php

namespace Cobalt\Model\Computer;

use DateTime;

class Computer implements ComputerInterface
{
    protected $computerId;
    protected $hostname;
    protected $domain;
    protected $manufacturer;
    protected $model;
    protected $serialNumber;
    protected $biosVersion;
    protected $systemType;
    protected $osName;
    protected $osVersion;
    protected $osBuild;
    protected $osServicePack;
    protected $created;
    protected $modified;
    
    public function getComputerId()
    {
        return $this->computerId; 
    }
    
    public function setComputerId($computerId)
    {
        $this->computerId = $computerId;
        return $this;
    }
    
    public function getHostname()
    {
        return $this->hostname;
    }
    
    public function setHostname($hostname)
    {
        $this->hostname = $hostname;
        return $this;
    }
    
    public function getDomain()
    {
        return $this->domain;
    }
    
    public function setDomain($domain)
    {
        $this->domain = $domain;
        return $this;
    }
    
    public function getManufacturer()
    {
        return $this->manufacturer;
    }
    
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;
        return $this;
    }
    
    public function getModel()
    {
        return $this->model;
    }
    
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }
    
    public function getSerialNumber()
    {
        return $this->serialNumber;
    }
    
    public function setSerialNumber($serialNumber)
    {
        $this->serialNumber = $serialNumber;
        return $this;
    }
    
    public function getBiosVersion()
    {
        return $this->biosVersion;
    }
    
    public function setBiosVersion($biosVersion)
    {
        $this->biosVersion = $biosVersion;
        return $this;
    }
    
    public function getSystemType()
    {
        return $this->systemType;
    }
    
    public function setSystemType($systemType)
    {
        $this->systemType = $systemType;
        return $this;
    }
    
    public function getOsName()
    {
        return $this->osName;
    }
    
    public function setOsName($osName)
    {
        $this->osName = $osName;
        return $this;
    }
    
    public function getOsVersion()
    {
        return $this->osVersion;
    }
    
    public function setOsVersion($osVersion)
    {
        $this->osVersion = $osVersion;
        return $this;
    }
    
    public function getOsBuild()
    {
        return $this->osBuild;
    }
    
    public function setOsBuild($osBuild)
    {
        $this->osBuild = $osBuild;
        return $this;
    }
    
    public function getOsServicePack()
    {
        return $this->osServicePack;
    }
    
    public function setOsServicePack($osServicePack)
    {
        $this->osServicePack = $osServicePack;
        return $this;
    }
    
    public function getCreated()
    {
        return $this->created;
    }
    
    public function setCreated($created)
    {
        if ($created instanceof DateTime) {
            $this->created = $created;
        } else {
            $this->created = new DateTime($created);
        }
        return $this;
    }
    
    public function getModified()
    {
        return $this->modified;
    }
    
    public function setModified($modified)
    {
        if ($modified instanceof DateTime) {
            $this->modified = $modified;
        } else {
            $this->modified = new DateTime($modified);
        }
        return $this;
    }
}

