<?php

namespace Cobalt\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class DomainController extends AbstractActionController
{
    public function indexAction()
    {
        $domain = $this->params()->fromRoute('id');
        $service = $this->getServiceLocator()->get('WhoisService');
        $result = $service->Lookup($domain);
        return array(
            'result' => $result
        );
    }
}