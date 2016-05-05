<?php

namespace Cobalt\Entity;

use Doctrine\ORM\Mapping as ORM;

class SoftwareManufacturer
{
    protected $id;
    protected $name;
    protected $address;
    protected $supportEmail;
    protected $websiteUrl;
    
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getSupportEmail()
    {
        return $this->supportEmail;
    }

    public function getWebsiteUrl()
    {
        return $this->websiteUrl;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    public function setSupportEmail($supportEmail)
    {
        $this->supportEmail = $supportEmail;
        return $this;
    }

    public function setWebsiteUrl($websiteUrl)
    {
        $this->websiteUrl = $websiteUrl;
        return $this;
    }


}
