<?php

namespace Cobalt\Controller;

class CompanyController extends AbstractController
{
    public function indexAction()
    {
        $companies = $this->service->findAll();
        
        return array(
            'companies' => $companies
        );
    }
}
