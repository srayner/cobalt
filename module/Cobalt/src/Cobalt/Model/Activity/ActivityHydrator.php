<?php

namespace Cobalt\Model\Activity;

use Zend\Stdlib\Hydrator\ClassMethods;
use Cobalt\Model\Activity\ActivityInterface;

class ActivityHydrator extends ClassMethods
{
    public function extract($object)
    {
        if (!$object instanceof ActivityInterface) {
            throw new Exception\InvalidArgumentException('$object must be an instance of Cobalt\Model\Activity\ActivityInterface');
        }
        $data = parent::extract($object);
        if ($data['activity_time']) {
            $data['activity_time'] = $data['activity_time']->format('Y-m-d H:i:s');
        }
        return $data;
    }
    
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof ActivityInterface) {
            throw new Exception\InvalidArgumentException('$object must be an instance of Cobalt\Model\Activity\ActivityInterface');
        }       
        return parent::hydrate($data, $object);
    }  
}