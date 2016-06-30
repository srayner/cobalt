<?php

namespace Cobalt\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity
  * @ORM\Table(name="logical_disk")
  */
class LogicalDisk
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", name="logical_disk_id")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Computer", inversedBy="logicalDisks")
     * @ORM\JoinColumn(name="computer_id", referencedColumnName="id")
     */
    protected $computer;
    
    /** @ORM\Column(type="string", name="device_id") */
    protected $deviceId;
    
    /** @ORM\Column(type="string") */
    protected $description;
    
    /** @ORM\Column(type="string", name="file_system") */
    protected $fileSystem;
    
    /** @ORM\Column(type="bigint") */
    protected $capacity;
    
    /** @ORM\Column(type="bigint", name="free_space") */
    protected $freeSpace;
    
    public function getId()
    {
        return $this->id;
    }

    public function getComputer()
    {
        return $this->computer;
    }

    public function getDeviceId()
    {
        return $this->deviceId;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getFileSystem()
    {
        return $this->fileSystem;
    }

    public function getCapacity()
    {
        return $this->capacity;
    }

    public function getFreeSpace()
    {
        return $this->freeSpace;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setComputer($computer)
    {
        $this->computer = $computer;
        return $this;
    }

    public function setDeviceId($deviceId)
    {
        $this->deviceId = $deviceId;
        return $this;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function setFileSystem($fileSystem)
    {
        $this->fileSystem = $fileSystem;
        return $this;
    }

    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
        return $this;
    }

    public function setFreeSpace($freeSpace)
    {
        $this->freeSpace = $freeSpace;
        return $this;
    }

    public function freeSpaceText()
    {
        if ($this->capacity == 0) {
            return '';
        } else {
            $value = ($this->freeSpace / $this->capacity)*100;
            return round($value, 0, PHP_ROUND_HALF_UP);
        }
    }
    
    public function freeSpacePercent()
    {
        if ($this->capacity == 0) {
            return null;
        } else {
            return ($this->freeSpace / $this->capacity)*100;
        }
    }
    
    public function freeSpaceClass()
    {
        $free = $this->freeSpacePercent();
        
        $result = 'progress-bar-success';
        if ($free < 33) {
            $result = 'progress-bar-warning';
        }
        if ($free < 25) {
            $result = 'progress-bar-danger';
        }
        
        return $result;
    }
}
