<?php

namespace FAQ\Controller;

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
        return new ViewModel();
    }
    
    public function addAction()
    {
        // Create a new form.
        $form = $this->getServiceLocator()->get('FAQ\QuestionForm');
         
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
          
            // Create a new question object.
            $question = $this->getServiceLocator()->get('FAQ\Question');
            
            $form->bind($question);
            $form->setData($data);
            if ($form->isValid())
            {
          	// Persist question.
            	$this->service->persist($question);
                
            	// Redirect to list of questions
		return $this->redirect()->toRoute('faq/default', array(
		    'controller' => 'index'
		));
            }
        } 
        
        // If not a POST request, or invalid data, then just render the form.
        return new ViewModel(array(
            'form'   => $form
        ));
    }
    
}
