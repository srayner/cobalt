<?php

namespace Cobalt\Model\Activity;

class Activity implements ActivityInterface
{
    protected $activityId;
    protected $activityType;
    protected $hostname;
    protected $username;
    protected $activityTime;
    
    public function getActivityId()
    {
        return $this->activityId;
    }
    
    public function setActivityId($activityId)
    {
        $this->activityId = $activityId;
        return $this;
    }
    
    public function getActivityType()
    {
        return $this->activityType;
    }
    
    public function setActivityType($activityType)
    {
        $this->activityType = $activityType;
        return $this;
    }
    
    public function getHostname()
    {
        return $this->hostname;
    }
    
    public function setHostname($hostname)
    {
        $this->hostname = $hostname;
        return $this;
    }
    
    public function getUsername()
    {
        return $this->username;
    }
    
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }
    
    public function getActivityTime()
    {
        return $this->activityTime;
    }
    
    public function setActivityTime($activityTime)
    {
        $this->activityTime = $activityTime;
        return $this;
    }
}