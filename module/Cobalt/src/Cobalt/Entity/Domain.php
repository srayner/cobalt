<?php

namespace Cobalt\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/** @ORM\Entity
  * @ORM\Table(name="domain")
  */
class Domain
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */  
    protected $id;
    
    /** @ORM\Column(type="string", name="domain_name") */
    protected $name;
    
    /** @ORM\Column(type="string") */
    protected $description;
    
    /**
     * @ORM\ManyToMany(targetEntity="NameServer")
     * @ORM\JoinTable(name="domain_name_server",
     *      joinColumns={@ORM\JoinColumn(name="domain_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="name_server_id", referencedColumnName="id", unique=true)}
     * )
     */
    protected $nameSevers;
    
    /**
     * @ORM\OneToMany(targetEntity="DomainStatus", mappedBy="domain")
     */
    protected $statuses;
    
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
    
    /** @ORM\Column(type="string", name="registrar_url") */
    protected $registrarUrl;
    
    public function __construct()
    {
        $this->nameServers = new ArrayCollection();
        $this->statuses = new ArrayCollection();
    }
    
    public function clearStatuses()
    {
        $this->statuses->clear();
    }
    
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

    public function getNameServers()
    {
        return $this->nameServers;
    }
    
    public function getStatuses()
    {
        return $this->statuses->toArray();
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

    public function addNameServer($nameServer)
    {
        $this->nameServers[] = $nameServer;
        return $this;
    }
    
    public function addStatus($status)
    {
        $this->statuses[] = $status;
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
