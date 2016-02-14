<?php

namespace Project\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity
  * @ORM\Table(name="task_priority")
  */
class TaskPriority
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    
    /** @ORM\Column(type="string", name="priority_name") */
    protected $name;
    
    /** @ORM\Column(type="string", name="priority_description") */
    protected $description;
    
    /** @ORM\Column(type="string") */
    protected $colour;
    
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

    public function getColour()
    {
        return $this->colour;
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
    
    public function setColour($colour)
    {
        $this->colour = $colour;
        return $this;
    }
}