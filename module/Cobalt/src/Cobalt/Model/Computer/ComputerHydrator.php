<?php

namespace Cobalt\Model\Computer;

use Zend\Stdlib\Hydrator\ClassMethods;
use Cobalt\Model\Computer\ComputerInterface;

class ComputerHydrator extends ClassMethods
{
    public function extract($object)
    {
        if (!$object instanceof ComputerInterface) {
            throw new \InvalidArgumentException('$object must be an instance of Cobalt\Model\Computer\ComputerInterface');
        }
        $data = parent::extract($object);
        if ($data['created']) {
            $data['created'] = $data['created']->format('Y-m-d H:i:s');
        }
        if ($data['modified']) {
            $data['modified'] = $data['modified']->format('Y-m-d H:i:s');
        }
        return $data;
    }
    
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof ComputerInterface) {
            throw new \InvalidArgumentException('$object must be an instance of Cobalt\Model\Computer\ComputerInterface');
        }       
        return parent::hydrate($data, $object);
    }  
}