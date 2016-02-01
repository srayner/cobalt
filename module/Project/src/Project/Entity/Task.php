<?php

namespace Project\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity
  * @ORM\Table(name="project")
  */
class task
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
    protected $description;
    
    /**
     * @ORM\ManyToOne(targetEntity="TaskStatus")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     */
    protected $status;
    
    /**
     * @ORM\ManyToOne(targetEntity="TaskPriority")
     * @ORM\JoinColumn(name="priority_id", referencedColumnName="id")
     */
    protected $priority;
    
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

    public function getStatus()
    {
        return $this->status;
    }
    
    public function getPriority()
    {
        return $this->priority;
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
    
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
    
    public function setPriority($priority)
    {
        $this->priority = $priority;
        return $this;
    }
}
