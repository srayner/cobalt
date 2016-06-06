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
        $template = $this->service->find('1');
        $form->bind($template);
        
        $request = $this->getRequest();
        if ($request->isPost())
        {    
            // Validate the data.
            $form->setData($request->getPost());
            if ($form->isValid())
            {
                // persist template
                $this->service->persist($template);
            }
            
            // Redirect to admin (for now)
            $this->redirect()->toRoute('admin');
        }
            
        return array(
            'form' => $form
        );

    }
}

