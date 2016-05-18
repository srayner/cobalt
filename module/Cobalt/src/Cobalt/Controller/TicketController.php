<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;

class TicketController extends AbstractController
{
    public function indexAction()
    {
        $tickets = $this->service->findAll();
        
        return new ViewModel(array(
            'tickets' => $tickets
        ));
    }
}