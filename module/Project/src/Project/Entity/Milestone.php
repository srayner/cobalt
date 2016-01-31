<?php

namespace Project\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity
  * @ORM\Table(name="milestone")
  */
class Milestone
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
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="milestones")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    protected $project;
    
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
    
    public function setProject($project)
    {
        $this->project = $project;
    }
    
    public function getProject()
    {
        return $this->project;
    }
}

