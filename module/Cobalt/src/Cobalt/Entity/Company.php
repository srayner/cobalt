<?php

namespace Cobalt\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/** @ORM\Entity
  * @ORM\Table(name="company")
  */
class Company
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
     * @ORM\OneToMany(targetEntity="Office", mappedBy="company")
     */
    protected $offices;
    
    /**
     * @ORM\OneToMany(targetEntity="Department", mappedBy="company")
     */
    protected $departments;
    
    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="company")
     */
    protected $users;
    
    public function __construct()
    {
        $this->offices     = new ArrayCollection();
        $this->departments = new ArrayCollection();
        $this->users       = new ArrayCollection();
    }
    
    public function addOffice($office)
    {
        $this->offices[] = $office;
    }
    
    public function addDepartment($department)
    {
        $this->departments[] = $department;
    }
    
    public function addUser($user)
    {
        $this->users[] = $user;
    }
    
    public function getOffices()
    {
        return $this->offices->toArray();
    }
    
    public function getDepartments()
    {
        return $this->departments->toArray();
    }

    public function getUsers()
    {
        return $this->users->toArray();
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