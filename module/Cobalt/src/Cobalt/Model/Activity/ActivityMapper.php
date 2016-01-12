<?php

namespace Cobalt\Model\Activity;

use ZfcBase\Mapper\AbstractDbMapper;
use Cobalt\Service\DbAdapterAwareInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;

class ActivityMapper extends AbstractDbMapper implements ActivityMapperInterface, DbAdapterAwareInterface
{
    protected $tableName = 'activity';
    
    public function getActivityForHost($hostname)
    {
        $select = $this->getSelect()
                       ->where(array('hostname' => $hostname));
        return $this->select($select);
    }
    
    public function getActivityForUser($username)
    {
        $select = $this->getSelect()
                       ->where(array('username' => $username));
        return $this->select($select);
    }
    
    public function persistActivity(ActivityInterface $activity)
    {
        $this->insert($activity, null, new ActivityHydrator);
        return $activity;        
    }
    
    protected function insert($entity, $tableName = null, HydratorInterface $hydrator = null)
    {
        $result = parent::insert($entity, $tableName, $hydrator);
        $entity->setActivityId($result->getGeneratedValue());
        return $result;
    }
}