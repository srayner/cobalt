<?php

namespace Project\Controller;

use Zend\View\Model\ViewModel;

class TaskController extends AbstractController
{
    public function indexAction()
    {
        return new ViewModel(array(
            'tasks' => $this->service->findAll()    
        ));
    }
    
    public function addAction()
    {
        $form = $this->getServiceLocator()->get('Project\TaskForm');
        
        $request = $this->getRequest();
        if($request->isPost())
        {
            $task = $this->getServiceLocator()->get('task');
            $form->bind($task);
            $form->setData($request->getPost());
            if ($form->isValid())
            {
                // Persist.
                $em = $this->service->getEntityManager();
                $task->setStatus($em->getReference('Project\Entity\TaskStatus', 1));
                $task->setPriority($em->getReference('Project\Entity\TaskPriority', 1));
                $this->service->persist($task);
                
                // Redirect.
                return $this->redirect()->toRoute('project/default', array(
                    'controller' => 'task'
		));
            }
            
        }
        
        return new ViewModel(array(
            'form' => $form
        ));
    }
    
    public function editAction()
    {
        return new ViewModel();
    }
    
    public function deleteAction()
    {
        return new ViewModel();
    }
}