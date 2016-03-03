<?php

namespace Project\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use DateTime;

class ProjectController extends AbstractController
{
    public function indexAction()
    {  
        return new ViewModel(array(
            'projects' => $this->service->findAll()    
        ));
    }
    
    public function addAction()
    {
        $form = $this->getServiceLocator()->get('project_form');
        
        $request = $this->getRequest();
        if($request->isPost())
        {
            $project = $this->getServiceLocator()->get('project');
            $form->bind($project);
            $form->setData($request->getPost());
            if ($form->isValid())
            {
                // Persist.
                $this->service->persist($project);
                
                // Redirect.
                return $this->redirect()->toRoute('project/default', array(
                    'controller' => 'project'
		));
            }
            
        }
        
        return new ViewModel(array(
            'form' => $form
        ));
    }
    
    public function editAction()
    {
        // Get a current copy of the entity.
        $id = (int)$this->params()->fromRoute('id');
        if (!$id) {
            return $this->redirect()->toRoute('project/default', array('controller' => 'project', 'action'=>'add'));
	}
        $project = $this->service->findById($id);
        
        // Create a new form instance and bind the entity to it.
        $form = $this->getServiceLocator()->get('project_form');
        $form->bind($project);

        // Check if this request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // Validate the data.
            $form->setData($request->getPost());
            if ($form->isValid())
            {
                $this->service->persist($project);

                // Create information message.
                $this->flashMessenger()->addMessage('Project ' . $project->getName() . ' successfully updated');

                // Redirect back to original referer.
                return $this->redirect()->toUrl($this->retrieveReferer());
            }
        }
		
        $this->storeReferer('project/edit');
        
	// Render (or re-render) the form.
	return new ViewModel(array(
            'id' => $id,
            'form' => $form,
        ));
    }
    
    public function deleteAction()
    {
        // Ensure we have an id, else redirect to index action.
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('project/default', array('controller' => 'project'));
        }
        
        $project = $this->service->findById($id);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            // Only perform delete if value posted was 'Yes'.
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $this->service->remove($project);
            }

            // Redirect to list of staff
            return $this->redirect()->toRoute('project/default', array('controller' => 'project'));
         }
         
        return new ViewModel(array(
            'project' => $project
        ));
    }
    
    public function detailAction()
    {
        // Ensure we have an id, else redirect to index action.
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
             return $this->redirect()->toRoute('project/default', array(
                 'controller' => 'project',
             ));
        }
        
        return new ViewModel(array(
            'project' => $this->service->findById($id)
        ));
        
    }
    
    public function commentAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        
        $form = $this->getServiceLocator()->get('Project\CommentForm');
        $request = $this->getRequest();
        if($request->isPost())
        {
            $comment = $this->getServiceLocator()->get('Project\Comment');
            $form->bind($comment);
            $form->setData($request->getPost());
            if ($form->isValid())
            {
                $comment->setCreatedTime(new DateTime);
                $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
                $project = $em->find('Project\Entity\Project', $id);
                $project->addComment($comment);
                $em->persist($comment);
                $em->persist($project);
                $em->flush();
                
               
                
                // Redirect.
                return $this->redirect()->toUrl($this->retrieveReferer());
            }
            
        }
        
        $this->storeReferer('project\comment');
        
        return new ViewModel(array(
            'form' => $form,
            'projectId' => $id
        ));
    }
    
    public function taskAction()
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
                $task->setStatus($em->getReference('Project\Entity\TaskStatus', 1));
                $task->setPriority($em->getReference('Project\Entity\TaskPriority', 1));
                if ($id) {
                    $project = $em->find('Project\Entity\Project', $id);
                    $project->addTask($task);
                }
                $em->persist($task);
                $em->persist($project);
                $em->flush();
                
                // Redirect.
                return $this->redirect()->toRoute('project/default',
                    array(
                        'controller' => 'project',
                        'action' => 'detail',
                        'id' => $id,
                    ),
                    array('fragment' => 'tasks')
		);
            }
        }
        
        return new ViewModel(array(
            'form' => $form,
            'projectId' => $id
        ));
    }
    
    private function storeReferer($except)
    {
        $referer = $this->getRequest()->getHeader('Referer')->uri()->getPath();
        if (strpos($referer, $except) === false) {
            $session = new Container('project');
            $session->referer = $referer;
        }
    }
    
    private function retrieveReferer()
    {
        $session = new Container('project');
        return $session->referer;
    }
}