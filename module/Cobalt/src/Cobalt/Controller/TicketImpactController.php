<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;

class TicketImpactController extends AbstractController
{
    public function indexAction()
    {
        return new ViewModel(array(
            'impacts' => $this->service->findAll()
        ));
    }
}