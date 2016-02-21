<?php

namespace Cobalt\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity
  * @ORM\Table(name="name_server")
  */
class NameServer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */ 
    protected $id;
    
    /** @ORM\Column(type="string") */
    protected $hostname;
    
    /** @ORM\Column(type="string") */
    protected $ipv4;
    
    public function getId()
    {
        return $this->id;
    }

    public function getHostname()
    {
        return $this->hostname;
    }

    public function getIpv4()
    {
        return $this->ipv4;
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

    public function setIpv4($ipv4)
    {
        $this->ipv4 = $ipv4;
        return $this;
    }


    
}

