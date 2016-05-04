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
        $questions = $this->service->findAll();
        
        return new ViewModel(array(
            'questions' => $questions
        ));
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
    
    public function editAction()
    {
        // Ensure we have an id, else redirect to add action.
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
             return $this->redirect()->toRoute('faq/default', array(
                 'controller' => 'index',
                 'action' => 'add'
             ));
        }
        
        // Grab the question with the specified id.
        $question = $this->service->findById($id);
        
        $form = $this->getServiceLocator()->get('FAQ\QuestionForm');
        $form->bind($question);
        $form->get('submit')->setAttribute('value', 'Edit');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
        
            $form->setData($request->getPost());
            if ($form->isValid()) {
                
                // Persist question.
            	$this->service->persist($question);
                
                // Redirect to list of questions
                return $this->redirect()->toRoute('faq/default', array(
                    'controller' => 'index'
                ));
            }     
        }
        
        return new ViewModel(array(
             'id' => $id,
             'form' => $form,
        ));
    }
    
    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        $question = $this->service->findById($id);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            // Only perform delete if value posted was 'Yes'.
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $this->service->remove($question);
            }

            // Redirect to domain index
            return $this->redirect()->toRoute('faq/default',
                array('controller' => 'index'));
         }
         
        return new ViewModel(array(
            'question' => $question
        ));
    }
    
}
