<?php

namespace Cobalt\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity
  * @ORM\Table(name="domain_status")
  */
class DomainStatus
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Domain", inversedBy="statuses")
     * @ORM\JoinColumn(name="domain_id", referencedColumnName="id")
     */
    protected $domain;
    
    /** @ORM\Column(type="string") */
    protected $status;
    
    public function getId()
    {
        return $this->id;
    }

    public function getDomain()
    {
        return $this->domain;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setDomain($domain)
    {
        $this->domain = $domain;
        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }


}

