<?php

namespace Project\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

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
    
    /**
     * @ORM\ManyToOne(targetEntity="MilestoneStatus")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     */
    protected $status;
    
    /**
     * @ORM\ManyToOne(targetEntity="MilestonePriority")
     * @ORM\JoinColumn(name="priority_id", referencedColumnName="id")
     */
    protected $priority;
    
    /**
     * @ORM\OneToMany(targetEntity="Task", mappedBy="milestone")
     */
    protected $tasks;
    
    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }
    
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

    public function getStatus()
    {
        return $this->status;
    }

    public function getPriority()
    {
        return $this->priority;
    }

    public function getTasks()
    {
        return $this->tasks;
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

