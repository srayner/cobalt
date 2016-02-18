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
    
    /** @ORM\Column(type="string") */
    protected $registrant_type;
    
    /** @ORM\Column(type="string") */
    protected $registrant_address;
    
    /** @ORM\Column(type="string") */
    protected $registrar;
    
    /** @ORM\Column(type="string") */
    protected $registrar_url;
    
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

    public function getExpires() {
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

    public function getRegistrant_type()
    {
        return $this->registrant_type;
    }

    public function getRegistrant_address()
    {
        return $this->registrant_address;
    }

    public function getRegistrar()
    {
        return $this->registrar;
    }

    public function getRegistrar_url()
    {
        return $this->registrar_url;
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

    public function setRegistrant_type($registrant_type)
    {
        $this->registrant_type = $registrant_type;
        return $this;
    }

    public function setRegistrant_address($registrant_address)
    {
        $this->registrant_address = $registrant_address;
        return $this;
    }

    public function setRegistrar($registrar)
    {
        $this->registrar = $registrar;
        return $this;
    }

    public function setRegistrar_url($registrar_url)
    {
        $this->registrar_url = $registrar_url;
        return $this;
    }


}

