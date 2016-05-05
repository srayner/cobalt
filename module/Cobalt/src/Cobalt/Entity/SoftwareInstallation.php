<?php

namespace Cobalt\Entity;

use Doctrine\ORM\Mapping as ORM;

class SoftwareInstallation
{
    protected $id;
    protected $computer;
    protected $software;
    protected $installedDate;
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

