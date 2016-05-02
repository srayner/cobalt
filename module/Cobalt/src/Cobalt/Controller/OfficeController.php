<?php

namespace Cobalt\Controller;

class OfficeController extends AbstractController
{
    public function indexAction()
    {
        $offices = $this->service->findAll();
        
        return array(
            'offices' => $offices
        );
    }
}
