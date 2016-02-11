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
        $id = (int)$this->params()->fromRoute('id');
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
                if ($id) {
                  $task->setMilestone($em->getReference('Project\Entity\Milestone', $id));
                }
                $task->setStatus($em->getReference('Project\Entity\TaskStatus', 1));
                $task->setPriority($em->getReference('Project\Entity\TaskPriority', 1));
                $this->service->persist($task);
                
                // Redirect.
                return $this->redirect()->toRoute('project/default',
                    array(
                        'controller' => 'milestone',
                        'action' => 'detail',
                        'id' => $id,
                    ),
                    array('fragment' => 'tasks')
		);
            }
            
        }
        
        return new ViewModel(array(
            'form' => $form,
            'milestoneId' => $id
        ));
    }
    
    public function editAction()
    {
        // Get a current copy of the entity.
        $id = (int)$this->params()->fromRoute('id');
        if (!$id) {
            return $this->redirect()->toRoute('project/default', array('controller' => 'task', 'action'=>'add'));
	}
        $task = $this->service->findById($id);
        
        // Create a new form instance and bind the entity to it.
        $form = $this->getServiceLocator()->get('Project\TaskForm');
        $form->bind($task);
        
        // Check if this request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // Validate the data.
            $form->setData($request->getPost());
            if ($form->isValid())
            {
                $this->service->persist($task);

                // Redirect.
                return $this->redirect()->toRoute('project/default',
                    array('controller' => 'milestone',
                          'action' => 'detail',
                          'id' => $task->getMilestone()->getId()
		    ),
                    array('fragment' => 'tasks')
                );
            }
        }
        
        return new ViewModel(array(
            'id' => $id,
            'form' => $form
        ));
    }
    
    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        $task = $this->service->findById($id);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            $milestoneId = $task->getMilestone()->getId();
            
            // Only perform delete if value posted was 'Yes'.
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $this->service->remove($task);
            }

            // Redirect to project detail
            return $this->redirect()->toRoute('project/default',
                array(
                    'controller' => 'milestone',
                    'action' => 'detail',
                    'id' => $milestoneId),
                array('fragment' => 'tasks')
            );
         }
         
        return new ViewModel(array(
            'task' => $task
        ));
    }
    
    public function detailAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        return new ViewModel(array(
            'task' => $this->service->findById($id)
        ));
    }
}