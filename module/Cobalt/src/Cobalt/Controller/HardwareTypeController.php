<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class HardwareTypeController extends AbstractController
{
    public function indexAction()
    {
        $types = $this->service->findAll();
        
        return new ViewModel(array(
            'types' => $types
        ));
    }
}