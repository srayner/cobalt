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
    
    /** @ORM\Column(type="integer", name="task_count") */
    protected $taskCount;
    
    /** @ORM\Column(type="integer", name="task_completed") */
    protected $taskCompleted;
    
    /**
     * @ORM\ManyToMany(targetEntity="Task")
     * @ORM\JoinTable(name="milestone_task",
     *      joinColumns={@ORM\JoinColumn(name="milestone_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="task_id", referencedColumnName="id", unique=true)}
     * )
     */
    protected $tasks;
    
    /**
     * @ORM\ManyToMany(targetEntity="Comment")
     * @ORM\JoinTable(name="milestone_comment",
     *      joinColumns={@ORM\JoinColumn(name="milestone_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="comment_id", referencedColumnName="id", unique=true)}
     * )
     */
    protected $comments;
    
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

    public function getTaskCount()
    {
        return $this->taskCount;
    }

    public function getTaskCompleted()
    {
        return $this->taskCompleted;
    }

    public function getTasks()
    {
        return $this->tasks;
    }

    public function getComments()
    {
        return $this->comments;
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

