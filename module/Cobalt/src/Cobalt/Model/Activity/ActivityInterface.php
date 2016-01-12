<?php

namespace Cobalt\Model\Activity;

interface ActivityInterface
{
    public function getActivityId();
    public function setActivityId($activityId);
    
    public function getHostname();
    public function setHostname($hostname);
    
    public function getUsername();
    public function setUsername($hostname);
    
    public function getActivityTime();
    public function setActivityTime($activityTime);
}