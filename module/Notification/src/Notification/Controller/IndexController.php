<?php

namespace Notification\Controller;

class IndexController
{
    protected $service;
    
    public function __construct($service)
    {
        $this->service = $service;
    }
    
    public function indexAction()
    {
        return new ViewModel(array(
           'notifications' => $this->service->findAll() 
        ));
    }
}

