<?php

namespace Cobalt\Form;

use Zend\InputFilter\InputFilter;

class ConsumableSelectFilter extends InputFilter
{
    public function __construct()
    {
        // consumable
        $this->add(array(
            'name'       => 'consumable',
            'required'   => true,
        ));
    }
}