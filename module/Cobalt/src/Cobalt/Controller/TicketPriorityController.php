<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;

class TicketPriorityController extends AbstractController
{
    public function indexAction()
    {
        return new ViewModel(array(
            'priorities' => $this->service->findAll()
        ));
    }
}