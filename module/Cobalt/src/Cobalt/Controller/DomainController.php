<?php

namespace Cobalt\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class DomainController extends AbstractActionController
{
    public function indexAction()
    {
        $domain = $this->params()->fromRoute('id');
        $domain = 'williams-refrigeration.co.uk';
        $service = $this->getServiceLocator()->get('WhoisService');
        $result = $service->Lookup($domain);
        die(var_dump($result['rawdata']));
        
        return array(
            'result' => $result
        );
    }
}