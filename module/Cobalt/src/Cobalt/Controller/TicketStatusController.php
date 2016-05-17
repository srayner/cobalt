<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;

class TicketStatusController extends AbstractController
{
    public function indexAction()
    {
        return new ViewModel(array(
            'states' => $this->service->findAll()
        ));
    }
}