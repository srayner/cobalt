<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;

class TicketCategoryController extends AbstractController
{
    public function indexAction()
    {
        return new ViewModel(array(
            'categories' => $this->service->findAll()
        ));
    }
}