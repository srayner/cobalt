<?php

namespace Cobalt\Model\LogicalDisk;

use Zend\Stdlib\Hydrator\ClassMethods;
use Cobalt\Model\LogicalDisk\LogicalDiskInterface;

class LogicalDiskHydrator extends ClassMethods
{
    public function extract($object)
    {
        if (!$object instanceof LogicalDiskInterface) {
            throw new Exception\InvalidArgumentException('$object must be an instance of Cobalt\Model\LogicalDisk\LogicalDiskInterface');
        }
        $data = parent::extract($object);
        unset($data['free_space_text']);
        unset($data['free_space_percent']);
        unset($data['free_space_class']);
        return $data;
    }
    
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof LogicalDiskInterface) {
            throw new Exception\InvalidArgumentException('$object must be an instance of Cobalt\Model\LogicalDisk\LogicalDiskInterface');
        }       
        return parent::hydrate($data, $object);
    }  
}