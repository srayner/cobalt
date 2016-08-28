<?php

namespace Cobalt\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="printer"
 */
class Printer extends Hardware
{
    /** @ORM\Column(type="string") */
    protected $technology;
    
    /** @ORM\Column(type="string") */
    protected $resolution;
    
    /** @ORM\Column(type="string") */
    protected $speed;
    
    /** @ORM\Column(type="string") */
    protected $quality;
    
    /** @ORM\Column(type="string", name="duty_cycle") */
    protected $dutyCycle;
    
    /**
     * @ORM\ManyToMany(targetEntity="Consumable", inversedBy="printers")
     * @ORM\JoinTable(name="printer_consumable",
     *     joinColumns={@ORM\JoinColumn(name="printer_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="consumable_id", referencedColumnName="id")}
     * )
     */
    protected $consumables;
    
    public function __construct()
    {
        $this->consumables = new ArrayCollection();
    }
    
    public function addConsumable($consumable)
    {
        $this->consumables[] = $consumable;
        $consumable->addPrinter($this);
        return $this;
    }
    
    public function removeConsumable($consumable)
    {
        $this->consumables->removeElement($consumable);
        $consumable->removePrinter($this);
        return $this;
    }
    
    public function getConsumables()
    {
        return $this->consumables->toArray();
    }
    
    public function getTechnology()
    {
        return $this->technology;
    }

    public function getResolution()
    {
        return $this->resolution;
    }

    public function getSpeed()
    {
        return $this->speed;
    }

    public function getQuality()
    {
        return $this->quality;
    }

    public function getDutyCycle()
    {
        return $this->dutyCycle;
    }

    public function setTechnology($technology)
    {
        $this->technology = $technology;
        return $this;
    }

    public function setResolution($resolution)
    {
        $this->resolution = $resolution;
        return $this;
    }

    public function setSpeed($speed)
    {
        $this->speed = $speed;
        return $this;
    }

    public function setQuality($quality)
    {
        $this->quality = $quality;
        return $this;
    }

    public function setDutyCycle($dutyCycle)
    {
        $this->dutyCycle = $dutyCycle;
        return $this;
    }
}
