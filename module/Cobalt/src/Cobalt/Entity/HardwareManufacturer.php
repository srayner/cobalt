<?php

namespace Cobalt\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity
  * @ORM\Table(name="hardware_manufacturer")
  */
class HardwareManufacturer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    
    /** @ORM\Column(type="string") */
    protected $name;
    
    /** @ORM\Column(type="text") */
    protected $address;
    
    /** @ORM\Column(type="string", name="email") */
    protected $email;
    
    /** @ORM\Column(type="string", name="website_url") */
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

    public function getemail()
    {
        return $this->email;
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

    public function setemail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function setWebsiteUrl($websiteUrl)
    {
        $this->websiteUrl = $websiteUrl;
        return $this;
    }


}
