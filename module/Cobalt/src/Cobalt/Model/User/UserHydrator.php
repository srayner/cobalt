<?php

namespace Cobalt\Model\User;

use Zend\Stdlib\Hydrator\ClassMethods;

class UserHydrator extends ClassMethods
{
    public function extract($object)
    {
        if (!$object instanceof UserInterface) {
            throw new Exception\InvalidArgumentException('$object must be an instance of Cobalt\Model\User\UserInterface');
        }
        $data = parent::extract($object);
    //    if ($data['created']) {
    //        $data['created'] = $data['created']->format('Y-m-d H:i:s');
    //    }
    //    if ($data['modified']) {
    //        $data['modified'] = $data['modified']->format('Y-m-d H:i:s');
    //    }
        return $data;
    }
    
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof UserInterface) {
            throw new Exception\InvalidArgumentException('$object must be an instance of Cobalt\Model\User\UserInterface');
        }       
        return parent::hydrate($data, $object);
    }  
}