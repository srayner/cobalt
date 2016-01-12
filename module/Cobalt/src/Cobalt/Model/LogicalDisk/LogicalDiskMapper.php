<?php

namespace Cobalt\Model\LogicalDisk;

use ZfcBase\Mapper\AbstractDbMapper;
use Cobalt\Service\DbAdapterAwareInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;

class LogicalDiskMapper extends AbstractDbMapper implements LogicalDiskMapperInterface, DbAdapterAwareInterface
{
    protected $tableName = 'logical_disk';
    
    public function getLogicalDisks($computerId)
    {
        $select = $this->getSelect()
                       ->where(array('computer_id' => $computerId));
        return $this->select($select);
    }
    
    public function persist(LogicalDiskInterface $logicalDisk)
    {
        $this->insert($logicalDisk, null, new LogicalDiskHydrator);
        return $logicalDisk;        
    }
    
    public function deleteLogicalDisks($computerId)
    {
        return parent::delete(array('computer_id' => $computerId));
    }
    
    protected function insert($entity, $tableName = null, HydratorInterface $hydrator = null)
    {
        $result = parent::insert($entity, $tableName, $hydrator);
   //     $entity->setLogicalDiskId($result->getGeneratedValue());
        return $result;
    }
}