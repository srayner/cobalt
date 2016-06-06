<?php

namespace Notification\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
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
    
    public function templateAction()
    {
        $form = $this->getServiceLocator()->get('Notification\TemplateForm');
        $id = (int)$this->params()->fromRoute('id');
        $notification = $this->service->find($id);
        $form->bind($notification);
        
        $request = $this->getRequest();
        if ($request->isPost())
        {    
            // Validate the data.
            $form->setData($request->getPost());
            if ($form->isValid())
            {
                // persist notification
                $this->service->persist($notification);
            }
            
            // Redirect to admin (for now)
            $this->redirect()->toRoute('notification');
        }
            
        return array(
            'form' => $form,
            'notification' => $notification,
            'fields' => array(
                'Requestor Display Name'   => '{{ RequestorDisplayName }}',
                'Ticket Id'                => '{{ TicketResolutionDate }}',
                'Ticket Status'            => '{{ TicketResolutionDate }}',
                'Technician Display Name'  => '{{ TicketResolutionDate }}',
                'Expected Resolution Date' => '{{ TicketResolutionDate }}',
            )
        );

    }
}

