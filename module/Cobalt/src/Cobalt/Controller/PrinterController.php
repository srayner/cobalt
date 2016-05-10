<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class PrinterController extends AbstractController
{
    public function indexAction()
    {
        $printers = $this->service->findAll();
        
        return new ViewModel(array(
            'printers' => $printers
        ));
    }
    
    public function addAction()
    {
        // Create a new form.
        $form = $this->getServiceLocator()->get('Cobalt\PrinterForm');
         
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
          
            // Create a new hardware object.
            $printer = $this->getServiceLocator()->get('Cobalt\Printer');
            
            $form->bind($printer);
            $form->setData($data);
            if ($form->isValid())
            {
          	// Persist printer.
                $type = $this->getServiceLocator()->get('Cobalt\HardwareType');
                $status = $this->getServiceLocator()->get('Cobalt\HardwareStatus');
                $manufacturer = $this->getServiceLocator()->get('Cobalt\HardwareManufacturer');
                $type->setName('test');
                $status->setName('test');
                $manufacturer->setName('test');
                $printer->setType($type);
                $printer->setStatus($status);
                $printer->setManufacturer($manufacturer);
                $this->service->persist($status);
                $this->service->persist($type);
                $this->service->persist($manufacturer);
            	$this->service->persist($printer);
                
            	// Redirect to list of printers
		return $this->redirect()->toRoute('cobalt/default', array(
		    'controller' => 'printer',
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