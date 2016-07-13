<?php

namespace Cobalt\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/** @ORM\Entity
  * @ORM\Table(name="computer")
  */
class Computer extends Hardware
{   
    /** @ORM\Column(type="string") */
    protected $hostname;
    
    /** @ORM\Column(type="string") */
    protected $domain;
    
    /** @ORM\Column(type="string", name="bios_version") */
    protected $biosVersion;
    
    /** @ORM\Column(type="string", name="system_type") */
    protected $systemType;
    
    /** @ORM\Column(type="string", name="os_name") */
    protected $osName;
    
    /** @ORM\Column(type="string", name="os_version") */
    protected $osVersion;
    
    /** @ORM\Column(type="string", name="os_build") */
    protected $osBuild;
    
    /** @ORM\Column(type="string", name="os_service_pack") */
    protected $osServicePack;
    
    /** @ORM\Column(type="datetime", name="created") */
    protected $created;
    
    /** @ORM\Column(type="datetime", name="modified") */
    protected $modified;

    /**
     * @ORM\OneToMany(targetEntity="LogicalDisk", mappedBy="computer", orphanRemoval=true, cascade={"persist", "remove"})
     */
    protected $logicalDisks;
    
    public function __construct()
    {
        parent::__construct();
        $this->logicalDisks = new ArrayCollection();
    }
    
    public function addLogicalDisk($logicalDisk)
    {
        $this->logicalDisks[] = $logicalDisk;
        $logicalDisk->setComputer($this);
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getHostname()
    {
        return $this->hostname;
    }

    public function getDomain()
    {
        return $this->domain;
    }

    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getSerialNumber()
    {
        return $this->serialNumber;
    }

    public function getBiosVersion()
    {
        return $this->biosVersion;
    }

    public function getSystemType()
    {
        return $this->systemType;
    }

    public function getOsName()
    {
        return $this->osName;
    }

    public function getOsVersion()
    {
        return $this->osVersion;
    }

    public function getOsBuild()
    {
        return $this->osBuild;
    }

    public function getOsServicePack()
    {
        return $this->osServicePack;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function getModified()
    {
        return $this->modified;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setHostname($hostname)
    {
        $this->hostname = $hostname;
        return $this;
    }

    public function setDomain($domain)
    {
        $this->domain = $domain;
        return $this;
    }

    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;
        return $this;
    }

    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    public function setSerialNumber($serialNumber)
    {
        $this->serialNumber = $serialNumber;
        return $this;
    }

    public function setBiosVersion($biosVersion)
    {
        $this->biosVersion = $biosVersion;
        return $this;
    }

    public function setSystemType($systemType)
    {
        $this->systemType = $systemType;
        return $this;
    }

    public function setOsName($osName)
    {
        $this->osName = $osName;
        return $this;
    }

    public function setOsVersion($osVersion)
    {
        $this->osVersion = $osVersion;
        return $this;
    }

    public function setOsBuild($osBuild)
    {
        $this->osBuild = $osBuild;
        return $this;
    }

    public function setOsServicePack($osServicePack)
    {
        $this->osServicePack = $osServicePack;
        return $this;
    }

    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    public function setModified($modified)
    {
        $this->modified = $modified;
        return $this;
    }
    
    public function getLogicalDisks()
    {
        return $this->logicalDisks;
    }
    
    public function clearLogicalDisks()
    {
        $this->logicalDisks->clear();
    }
}
