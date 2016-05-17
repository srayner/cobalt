<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class TicketCategoryController extends AbstractController
{
    public function indexAction()
    {
        return new ViewModel(array(
            'categories' => $this->service->findAll()
        ));
    }
    
    private function storeReferer($except)
    {
        $referer = $this->getRequest()->getHeader('Referer')->uri()->getPath();
        if (strpos($referer, $except) === false) {
            $session = new Container('ticketcategory');
            $session->referer = $referer;
        }
    }
    
    private function retrieveReferer()
    {
        $session = new Container('ticketcategory');
        $referer = $session->referer;
        return $referer;
    }
}