<?php

namespace Cobalt\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity
  * @ORM\Table(name="software_installation")
  */
class SoftwareInstallation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Computer")
     * @ORM\JoinColumn(name="computer_id", referencedColumnName="computer_id")
     */
    protected $computer;
    
    /**
     * @ORM\ManyToOne(targetEntity="Software")
     * @ORM\JoinColumn(name="software_id", referencedColumnName="id")
     */
    protected $software;
    
    /** @ORM\Column(type="date") */
    protected $installedDate;
    
    /** @ORM\Column(type="string") */
    protected $licenseKey;
    
    public function getId()
    {
        return $this->id;
    }

    public function getComputer()
    {
        return $this->computer;
    }

    public function getSoftware()
    {
        return $this->software;
    }

    public function getInstalledDate()
    {
        return $this->installedDate;
    }

    public function getLicenseKey()
    {
        return $this->licenseKey;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setComputer($computer)
    {
        $this->computer = $computer;
        return $this;
    }

    public function setSoftware($software)
    {
        $this->software = $software;
        return $this;
    }

    public function setInstalledDate($installedDate)
    {
        $this->installedDate = $installedDate;
        return $this;
    }

    public function setLicenseKey($licenseKey)
    {
        $this->licenseKey = $licenseKey;
        return $this;
    }


}

