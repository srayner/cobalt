<?php

namespace Cobalt\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity
  * @ORM\Table(name="ticket")
  */
class Ticket
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    
    /** @ORM\Column(type="datetime") */
    protected $raised;
    
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="raised_by_id", referencedColumnName="id")
     */
    protected $raisedBy;
    
    /** @ORM\Column(type="string") */
    protected $subject;
    
    /**
     * @ORM\ManyToOne(targetEntity="TicketStatus")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     */
    protected $status;
    
    /**
     * @ORM\ManyToOne(targetEntity="TicketType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    protected $type;
    
    /**
     * @ORM\ManyToOne(targetEntity="TicketCategory")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;
    
    /**
     * @ORM\ManyToOne(targetEntity="TicketPriority")
     * @ORM\JoinColumn(name="priority_id", referencedColumnName="id")
     */
    protected $priority;
    
    /**
     * @ORM\ManyToOne(targetEntity="TicketImpact")
     * @ORM\JoinColumn(name="impact_id", referencedColumnName="id")
     */
    protected $impact;
    
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="requestor_id", referencedColumnName="id")
     */
    protected $requestor;
    
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="technician_id", referencedColumnName="id")
     */
    protected $technician;
    
    /** @ORM\Column(type="text") */
    protected $problem;
    
    /** @ORM\Column(type="text") */
    protected $solution;
    
    /**
     * @ORM\ManyToOne(targetEntity="Hardware")
     * @ORM\JoinColumn(name="hardware_id", referencedColumnName="id")
     */
    protected $hardware;
    
    /**
     * @ORM\ManyToOne(targetEntity="Software")
     * @ORM\JoinColumn(name="software_id", referencedColumnName="id")
     */
    protected $software;
    
    /** @ORM\Column(type="datetime", name="response_due") */
    protected $responseDue;
    
    /** @ORM\Column(type="datetime", name="resolution_due") */
    protected $resolutionDue;
    
    /** @ORM\Column(type="string", name="external_ref") */
    protected $externalRef;
 
    public function getId()
    {
        return $this->id;
    }

    public function getRaised()
    {
        return $this->raised;
    }

    public function getRaisedBy()
    {
        return $this->raisedBy;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getPriority()
    {
        return $this->priority;
    }

    public function getImpact()
    {
        return $this->impact;
    }

    public function getRequestor()
    {
        return $this->requestor;
    }

    public function getTechnician()
    {
        return $this->technician;
    }

    public function getProblem()
    {
        return $this->problem;
    }

    public function getSolution()
    {
        return $this->solution;
    }

    public function getHardware()
    {
        return $this->hardware;
    }

    public function getSoftware()
    {
        return $this->software;
    }

    public function getResponseDue()
    {
        return $this->responseDue;
    }

    public function getResolutionDue()
    {
        return $this->resolutionDue;
    }

    public function getExternalRef()
    {
        return $this->externalRef;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setRaised($raised)
    {
        $this->raised = $raised;
        return $this;
    }

    public function setRaisedBy($raisedBy)
    {
        $this->raisedBy = $raisedBy;
        return $this;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    public function setPriority($priority)
    {
        $this->priority = $priority;
        return $this;
    }

    public function setImpact($impact)
    {
        $this->impact = $impact;
        return $this;
    }

    public function setRequestor($requestor)
    {
        $this->requestor = $requestor;
        return $this;
    }

    public function setTechnician($technician)
    {
        $this->technician = $technician;
        return $this;
    }

    public function setProblem($problem)
    {
        $this->problem = $problem;
        return $this;
    }

    public function setSolution($solution)
    {
        $this->solution = $solution;
        return $this;
    }

    public function setHardware($hardware)
    {
        $this->hardware = $hardware;
        return $this;
    }

    public function setSoftware($software)
    {
        $this->software = $software;
        return $this;
    }

    public function setResponseDue($responseDue)
    {
        $this->responseDue = $responseDue;
        return $this;
    }

    public function setResolutionDue($resolutionDue)
    {
        $this->resolutionDue = $resolutionDue;
        return $this;
    }

    public function setExternalRef($externalRef)
    {
        $this->externalRef = $externalRef;
        return $this;
    }


}
