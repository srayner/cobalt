<?php

namespace Cobalt\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/** @ORM\Entity
  * @ORM\Table(name="office")
  */
class office
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
    
    /** @ORM\Column(type="string") */
    protected $phone;
    
    /** @ORM\Column(type="string") */
    protected $fax;
    
    /**
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="offices")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    protected $company;
    
    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="office")
     */
    protected $users;
    
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }
    
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

    public function getPhone()
    {
        return $this->phone;
    }
    
    public function getFax()
    {
        return $this->fax;
    }
    
    public function getCompany()
    {
        return $this->company;
    }
    
    public function getUsers()
    {
        return $this->users->toArray();
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

    public function setCompany($company)
    {
        $this->company = $company;
        return $this;
    }
    
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    public function setFax($fax)
    {
        $this->fax = $fax;
        return $this;
    }
}