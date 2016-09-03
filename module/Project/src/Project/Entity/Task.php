<?php

namespace Project\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/** @ORM\Entity
  * @ORM\Table(name="task")
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
    
    /** @ORM\Column(name="estimated_hours", type="decimal") */
    protected $estimatedHours;
    
    /** @ORM\Column(name="actual_hours", type="decimal") */
    protected $actualHours;
    
    /**
     * @ORM\ManyToMany(targetEntity="Project", mappedBy="tasks")
     */
    protected $project;
    
    /**
     * @ORM\ManyToMany(targetEntity="Milestone", mappedBy="tasks")
     */
    protected $milestone;
    
    /**
     * @ORM\ManyToMany(targetEntity="Comment")
     * @ORM\JoinTable(name="task_comment",
     *      joinColumns={@ORM\JoinColumn(name="task_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="comment_id", referencedColumnName="id", unique=true)}
     * )
     */
    protected $comments;
    
    public function __construct()
    {
        $this->project = new ArrayCollection();
        $this->milestone = new ArrayCollection();
        $this->comments = new ArrayCollection();
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

    public function getStatus()
    {
        return $this->status;
    }

    public function getPriority()
    {
        return $this->priority;
    }

    public function getEstimatedHours()
    {
        return $this->estimatedHours;
    }

    public function getActualHours()
    {
        return $this->actualHours;
    }

    public function getProject()
    {
        return $this->project->first();
    }
    
    public function getMilestone()
    {
        return $this->milestone->first();
    }
    
    public function getComments()
    {
        return $this->comments;
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

    public function setEstimatedHours($estimatedHours)
    {
        $this->estimatedHours = $estimatedHours;
        return $this;
    }

    public function setActualHours($actualHours)
    {
        $this->actualHours = $actualHours;
        return $this;
    }
    
    public function setMilestone($milestone)
    {
        $this->milestone = $milestone;
        return $this;
    }
    
    public function addComment($comment)
    {
        $this->comments[] = $comment;
    }
}
