<?php

namespace Project\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity
  * @ORM\Table(name="milestone_priority")
  */
class MilestonePriority
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


}