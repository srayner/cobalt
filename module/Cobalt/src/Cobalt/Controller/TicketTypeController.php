<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;

class TicketTypeController extends AbstractController
{
    public function indexAction()
    {
        return new ViewModel(array(
            'types' => $this->service->findAll()
        ));
    }
}