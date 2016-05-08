<?php

namespace Cobalt\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table="printer"
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
