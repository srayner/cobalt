<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class TicketPriorityController extends AbstractController
{
    public function indexAction()
    {
        return new ViewModel(array(
            'priorities' => $this->service->findAll()
        ));
    }
    
    private function storeReferer($except)
    {
        $referer = $this->getRequest()->getHeader('Referer')->uri()->getPath();
        if (strpos($referer, $except) === false) {
            $session = new Container('ticketpriority');
            $session->referer = $referer;
        }
    }
    
    private function retrieveReferer()
    {
        $session = new Container('ticketpriority');
        $referer = $session->referer;
        return $referer;
    }
}