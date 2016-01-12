<?php

namespace Cobalt\Model\Activity;

interface ActivityMapperInterface
{
    public function getActivityForHost($hostname);
    public function getActivityForUser($username);
    public function persistActivity(ActivityInterface $activity);
}
