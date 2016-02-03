<?php

namespace Project\Hydrator\Strategy;

use Zend\Stdlib\Hydrator\Strategy\DefaultStrategy;

class NullStrategy extends DefaultStrategy
{
    public function hydrate($value)
    {
        if($value == '') {
            return NULL;
        }
        return $value;
    }
}