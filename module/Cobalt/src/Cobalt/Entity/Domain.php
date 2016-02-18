<?php

namespace Cobalt\Entity;

class Domain
{
    /** @ORM\Entity
      * @ORM\Table(name="domain")
      */
    protected $id;
    
    /** @ORM\Column(type="string", name="domain_name") */
    protected $name;
    
    /** @ORM\Column(type="string") */
    protected $description;
    
    /** @ORM\Column(type="string") */
    protected $status;
    
    /** @ORM\Column(type="date") */
    protected $created;
    
    /** @ORM\Column(type="date") */
    protected $changed;
    
    /** @ORM\Column(type="date") */
    protected $expires;
    
    /** @ORM\Column(type="string") */
    protected $sponsor;
    
    /** @ORM\Column(type="string") */
    protected $referer;
    
    /** @ORM\Column(type="string") */
    protected $handle;
    
    /** @ORM\Column(type="string") */
    protected $source;
    
    /** @ORM\Column(type="string") */
    protected $dnssec;
    
    /** @ORM\Column(type="string") */
    protected $registrant;
    
    /** @ORM\Column(type="string", name="registrant_type") */
    protected $registrantType;
    
    /** @ORM\Column(type="string", name="registrant_address") */
    protected $registrantAddress;
    
    /** @ORM\Column(type="string") */
    protected $registrar;
    
    /** @ORM\Column(type="string", name="registrant_url) */
    protected $registrarUrl;
    
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function getChanged()
    {
        return $this->changed;
    }

    public function getExpires()
    {
        return $this->expires;
    }

    public function getSponsor()
    {
        return $this->sponsor;
    }

    public function getReferer()
    {
        return $this->referer;
    }

    public function getHandle()
    {
        return $this->handle;
    }

    public function getSource()
    {
        return $this->source;
    }

    public function getDnssec()
    {
        return $this->dnssec;
    }

    public function getRegistrant()
    {
        return $this->registrant;
    }

    public function getRegistrantType()
    {
        return $this->registrantType;
    }

    public function getRegistrantAddress()
    {
        return $this->registrantAddress;
    }

    public function getRegistrar()
    {
        return $this->registrar;
    }

    public function getRegistrarUrl()
    {
        return $this->registrarUrl;
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

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    public function setChanged($changed)
    {
        $this->changed = $changed;
        return $this;
    }

    public function setExpires($expires)
    {
        $this->expires = $expires;
        return $this;
    }

    public function setSponsor($sponsor)
    {
        $this->sponsor = $sponsor;
        return $this;
    }

    public function setReferer($referer)
    {
        $this->referer = $referer;
        return $this;
    }

    public function setHandle($handle)
    {
        $this->handle = $handle;
        return $this;
    }

    public function setSource($source)
    {
        $this->source = $source;
        return $this;
    }

    public function setDnssec($dnssec)
    {
        $this->dnssec = $dnssec;
        return $this;
    }

    public function setRegistrant($registrant)
    {
        $this->registrant = $registrant;
        return $this;
    }

    public function setRegistrantType($registrantType)
    {
        $this->registrantType = $registrantType;
        return $this;
    }

    public function setRegistrantAddress($registrantAddress)
    {
        $this->registrantAddress = $registrantAddress;
        return $this;
    }

    public function setRegistrar($registrar)
    {
        $this->registrar = $registrar;
        return $this;
    }

    public function setRegistrarUrl($registrarUrl)
    {
        $this->registrarUrl = $registrarUrl;
        return $this;
    }
}
