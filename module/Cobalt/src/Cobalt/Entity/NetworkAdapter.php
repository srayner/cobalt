<?php

namespace Cobalt\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity
  * @ORM\Table(name="network_adapter")
  */
class NetworkAdapter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Hardware", inversedBy="networkAdapters")
     * @ORM\JoinColumn(name="hardware_id", referencedColumnName="id")
     */
    protected $hardware;
    
    /** @ORM\Column(type="string") */
    protected $name;
    
    /** @ORM\Column(type="string", name="dns_suffix") */
    protected $dnsSuffix;
    
    /** @ORM\Column(type="string", name="ipv6_address") */
    protected $ipv6Address;
    
    /** @ORM\Column(type="string", name="temp_ipv6_address") */
    protected $tempIpv6Address;
    
    /** @ORM\Column(type="string", name="local_ipv6_address") */
    protected $localIpv6Address;
    
    /** @ORM\Column(type="string", name="physical_address") */
    protected $physicalAddress;
    
    /** @ORM\Column(type="string", name="ipv4_address") */
    protected $ipv4Address;
    
    /** @ORM\Column(type="string", name="subnet_mask") */
    protected $subnetMask;
    
    /** @ORM\Column(type="string", name="default_gateway") */
    protected $defaultGateway;
    
    /** @ORM\Column(type="string", name="dhcp_enabled") */
    protected $dhcpEnabled;
    
    /** @ORM\Column(type="string", name="preferred_dns_server") */
    protected $preferredDnsServer;
    
    /** @ORM\Column(type="string", name="alternate_dns_server") */
    protected $alternateDnsServer;
    
    public function getId()
    {
        return $this->id;
    }

    public function getHardware()
    {
        return $this->hardware;
    }
    
    public function getName()
    {
        return $this->name;
    }

    public function getDnsSuffix()
    {
        return $this->dnsSuffix;
    }

    public function getIpv6Address()
    {
        return $this->ipv6Address;
    }

    public function getTempIpv6Address()
    {
        return $this->tempIpv6Address;
    }

    public function getLocalIpv6Address()
    {
        return $this->localIpv6Address;
    }

    public function getPhysicalAddress()
    {
        return $this->physicalAddress;
    }

    public function getIpv4Address()
    {
        return $this->ipv4Address;
    }

    public function getSubnetMask()
    {
        return $this->subnetMask;
    }

    public function getDefaultGateway()
    {
        return $this->defaultGateway;
    }

    public function getDhcpEnabled()
    {
        return $this->dhcpEnabled;
    }

    public function getPreferredDnsServer()
    {
        return $this->preferredDnsServer;
    }

    public function getAlternateDnsServer()
    {
        return $this->alternateDnsServer;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setHardware(Hardware $hardware)
    {
        $this->hardware = $hardware;
        return $this;
    }
    
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setDnsSuffix($dnsSuffix)
    {
        $this->dnsSuffix = $dnsSuffix;
        return $this;
    }

    public function setIpv6Address($ipv6Address)
    {
        $this->ipv6Address = $ipv6Address;
        return $this;
    }

    public function setTempIpv6Address($tempIpv6Address)
    {
        $this->tempIpv6Address = $tempIpv6Address;
        return $this;
    }

    public function setLocalIpv6Address($localIpv6Address)
    {
        $this->localIpv6Address = $localIpv6Address;
        return $this;
    }

    public function setPhysicalAddress($physicalAddress)
    {
        $this->physicalAddress = $physicalAddress;
        return $this;
    }

    public function setIpv4Address($ipv4Address)
    {
        $this->ipv4Address = $ipv4Address;
        return $this;
    }

    public function setSubnetMask($subnetMask)
    {
        $this->subnetMask = $subnetMask;
        return $this;
    }

    public function setDefaultGateway($defaultGateway)
    {
        $this->defaultGateway = $defaultGateway;
        return $this;
    }

    public function setDhcpEnabled($dhcpEnabled)
    {
        $this->dhcpEnabled = $dhcpEnabled;
        return $this;
    }

    public function setPreferredDnsServer($preferredDnsServer)
    {
        $this->preferredDnsServer = $preferredDnsServer;
        return $this;
    }

    public function setAlternateDnsServer($alternateDnsServer)
    {
        $this->alternateDnsServer = $alternateDnsServer;
        return $this;
    }    
}
