<?php

namespace Project\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/** @ORM\Entity
  * @ORM\Table(name="project")
  */
class Project
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    
    /** @ORM\Column(type="string") */
    protected $code;
    
    /** @ORM\Column(type="string") */
    protected $name;
    
    /**
     * @ORM\ManyToOne(targetEntity="ProjectStatus")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     */
    protected $status;
    
    /**
     * @ORM\ManyToOne(targetEntity="ProjectPriority")
     * @ORM\JoinColumn(name="priority_id", referencedColumnName="id")
     */
    protected $priority;
    
    /** @ORM\Column(type="text") */
    protected $description;
    
    /** @ORM\Column(type="datetime", name="scheduled_start") */
    protected $scheduledStart;
    
    /** @ORM\Column(type="datetime", name="scheduled_end") */
    protected $scheduledEnd;
    
    /** @ORM\Column(type="datetime", name="actual_start") */
    protected $actualStart;
    
    /** @ORM\Column(type="datetime", name="actual_end") */
    protected $actualEnd;
    
    /** @ORM\Column(type="date", name="projected_completion") */
    protected $projectedCompletion;
    
    /** @ORM\Column(type="decimal", name="estimated_hours") */
    protected $estimatedHours;
    
    /** @ORM\Column(type="decimal", name="actual_hours") */
    protected $actualHours;
    
    /** @ORM\Column(type="decimal", name="estimated_cost") */
    protected $estimatedCost;
    
    /** @ORM\Column(type="decimal", name="actual_cost") */
    protected $actualCost;
    
    /**
     * @ORM\OneToMany(targetEntity="Milestone", mappedBy="project")
     */
    protected $milestones;
    
    public function __construct()
    {
        $this->milestones = new ArrayCollection();
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getStatus()
    {
        return $this->status;
    }
    
    public function getPriority()
    {
        return $this->priority;
    }
    
    public function getDescription()
    {
        return $this->description;
    }

    public function getScheduledStart()
    {
        return $this->scheduledStart;
    }

    public function getScheduledEnd()
    {
        return $this->scheduledEnd;
    }

    public function getActualStart()
    {
        return $this->actualStart;
    }

    public function getActualEnd()
    {
        return $this->actualEnd;
    }

    public function getProjectedCompletion()
    {
        return $this->projectedCompletion;
    }

    public function getEstimatedHours()
    {
        return $this->estimatedHours;
    }

    public function getActualHours()
    {
        return $this->actualHours;
    }

    public function getEstimatedCost()
    {
        return $this->estimatedCost;
    }

    public function getActualCost()
    {
        return $this->actualCost;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
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
    
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function setScheduledStart($scheduledStart)
    {
        $this->scheduledStart = $scheduledStart;
        return $this;
    }

    public function setScheduledEnd($scheduledEnd)
    {
        $this->scheduledEnd = $scheduledEnd;
        return $this;
    }

    public function setActualStart($actualStart)
    {
        $this->actualStart = $actualStart;
        return $this;
    }

    public function setActualEnd($actualEnd)
    {
        $this->actualEnd = $actualEnd;
        return $this;
    }

    public function setProjectedCompletion($projectedCompletion)
    {
        $this->projectedCompletion = $projectedCompletion;
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

    public function setEstimatedCost($estimatedCost)
    {
        $this->estimatedCost = $estimatedCost;
        return $this;
    }

    public function setActualCost($ActualCost)
    {
        $this->ActualCost = $ActualCost;
        return $this;
    }    
}
