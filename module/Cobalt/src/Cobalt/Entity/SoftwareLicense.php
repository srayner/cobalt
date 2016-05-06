<?php

namespace Cobalt\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity
  * @ORM\Table(name="software_license")
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
     * @ORM\ManyToOne(targetEntity="Software")
     * @ORM\JoinColumn(name="software_id", referencedColumnName="id")
     */
    protected $software;
    
    /** @ORM\Column(type="string") */
    protected $licenseKey;
    
     /** @ORM\Column(type="integer") */
    protected $installationsAllowed;
    
    public function getId()
    {
        return $this->id;
    }

    public function getSoftware()
    {
        return $this->software;
    }

    public function getLicenseKey()
    {
        return $this->licenseKey;
    }

    public function getInstallationsAllowed()
    {
        return $this->installationsAllowed;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setSoftware($software)
    {
        $this->software = $software;
        return $this;
    }

    public function setLicenseKey($licenseKey)
    {
        $this->licenseKey = $licenseKey;
        return $this;
    }

    public function setInstallationsAllowed($installationsAllowed)
    {
        $this->installationsAllowed = $installationsAllowed;
        return $this;
    }


}