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
    
    /** @ORM\Column(type="integer", name="milestone_count") */
    protected $milestoneCount;
    
    /** @ORM\Column(type="integer", name="milestone_completed") */
    protected $milestoneCompleted;
    
    /** @ORM\Column(type="integer", name="task_count") */
    protected $taskCount;
    
    /** @ORM\Column(type="integer", name="task_completed") */
    protected $taskCompleted;
    
    /**
     * @ORM\OneToMany(targetEntity="Milestone", mappedBy="project")
     */
    protected $milestones;
    
    /**
     * @ORM\ManyToMany(targetEntity="Task")
     * @ORM\JoinTable(name="project_task",
     *      joinColumns={@ORM\JoinColumn(name="project_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="task_id", referencedColumnName="id", unique=true)}
     * )
     */
    protected $tasks;
    
    /**
     * @ORM\ManyToMany(targetEntity="Comment")
     * @ORM\JoinTable(name="project_comment",
     *      joinColumns={@ORM\JoinColumn(name="project_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="comment_id", referencedColumnName="id", unique=true)}
     * )
     */
    protected $comments;
    
    public function __construct()
    {
        $this->milestones = new ArrayCollection();
        $this->comments = new ArrayCollection();
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

    public function getMilestoneCount()
    {
        return $this->milestoneCount;
    }

    public function getMilestoneCompleted()
    {
        return $this->milestoneCompleted;
    }
    
    public function getTaskCount()
    {
        return $this->taskCount;
    }

    public function getTaskCompleted()
    {
        return $this->taskCompleted;
    }
    
    public function getMilestones()
    {
        return $this->milestones;
    }

    public function getTasks()
    {
        return $this->tasks;
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

    public function setActualCost($actualCost)
    {
        $this->actualCost = $actualCost;
        return $this;
    }
    
    public function setMilestones($milestones)
    {
        $this->milestones = $milestones;
        return $this;
    }
    
    public function setMilestoneCount($milestoneCount)
    {
        $this->milestoneCount = $milestoneCount;
        return $this;
    }

    public function setMilestoneCompleted($milestoneCompleted)
    {
        $this->milestoneCompleted = $milestoneCompleted;
        return $this;
    }
    
    public function setTaskCount($taskCount)
    {
        $this->taskCount = $taskCount;
        return $this;
    }

    public function setTaskCompleted($taskCompleted)
    {
        $this->taskCompleted = $taskCompleted;
        return $this;
    }
    
    public function addTask($task)
    {
        $this->tasks[] = $task;
    }
    
    public function addComment($comment)
    {
        $this->comments[] = $comment;
    }
}
