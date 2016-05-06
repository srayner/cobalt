<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;

class SoftwareTypeController extends AbstractController
{
    public function indexAction()
    {
        $types = $this->service->findAll();
        
        return new ViewModel(array(
            'types' => $types
        ));

    }
    
    public function addAction()
    {
        return new ViewModel(array(
            
        ));
    }
    
    public function editAction()
    {
        return new ViewModel(array(
            
        ));
    }
    
    public function deleteAction()
    {
        return new ViewModel(array(
            
        ));
    }
    
    public function detialAction()
    {
        return new ViewModel(array(
            
        ));
    }
}