<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class HardwareController extends AbstractController
{
    public function indexAction()
    {
        $hardware = $this->service->findAll();
        
        return new ViewModel(array(
            'hardware' => $hardware
        ));
    }
    
    public function addAction()
    {
        // Create a new form.
        $form = $this->getServiceLocator()->get('Cobalt\HardwareForm');
         
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
          
            // Create a new hardware object.
            $hardware = $this->getServiceLocator()->get('Cobalt\Hardware');
            
            $form->bind($hardware);
            $form->setData($data);
            if ($form->isValid())
            {
          	// Persist hardware.
                $type = $this->getServiceLocator()->get('Cobalt\HardwareType');
                $status = $this->getServiceLocator()->get('Cobalt\HardwareStatus');
                $manufacturer = $this->getServiceLocator()->get('Cobalt\HardwareManufacturer');
                $type->setName('test');
                $status->setName('test');
                $manufacturer->setName('test');
                $hardware->setType($type);
                $hardware->setStatus($status);
                $hardware->setManufacturer($manufacturer);
                $this->service->persist($status);
                $this->service->persist($type);
                $this->service->persist($manufacturer);
            	$this->service->persist($hardware);
                
            	// Redirect to list of hardware
		return $this->redirect()->toRoute('cobalt/default', array(
		    'controller' => 'hardware',
                    'action'     => 'index'
		));
            }
        } 
        
        // If not a POST request, or invalid data, then just render the form.
        return new ViewModel(array(
            'form'   => $form
        ));
    }
}
