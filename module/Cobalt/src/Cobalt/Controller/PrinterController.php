<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class PrinterController extends AbstractController
{
    public function indexAction()
    {
        $printers = $this->service->findAll();
        
        return new ViewModel(array(
            'printers' => $printers
        ));
    }
}