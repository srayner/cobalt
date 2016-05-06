<?php

namespace Cobalt\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity
  * @ORM\Table(name="software")
  */
class Software
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    
    /** @ORM\Column(type="string") */
    protected $name;
    
    /** @ORM\Column(type="string") */
    protected $version;
    
    /**
     * @ORM\ManyToOne(targetEntity="SoftwareManufacturer")
     * @ORM\JoinColumn(name="manufacturer_id", referencedColumnName="id")
     */
    protected $manufacturer;
    
    /**
     * @ORM\ManyToOne(targetEntity="SoftwareCategory")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $type;
    
    /**
     * @ORM\ManyToOne(targetEntity="SoftwareType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    protected $category;
    
    /** @ORM\Column(type="integer") */
    protected $installation_count;
    
    /** @ORM\Column(type="text") */
    protected $description;
    
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getInstallation_count()
    {
        return $this->installation_count;
    }

    public function getDescription()
    {
        return $this->description;
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

    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;
        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    public function setInstallation_count($installation_count)
    {
        $this->installation_count = $installation_count;
        return $this;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }


}