<?php

namespace Project\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use DateTime;

class MilestoneController extends AbstractController
{
    public function indexAction()
    {
        return new ViewModel(array(
            'milestones' => $this->service->findAll()    
        ));
    }
    
    public function addAction()
    {
        // Check we have a project id, if not redirect back to list of projects.
        $id = (int)$this->params()->fromRoute('id');
        if (!$id) {
            return $this->redirect()->toRoute('project/default', array('controller' => 'project'));
	}
        
        $form = $this->getServiceLocator()->get('Project\MilestoneForm');
        $request = $this->getRequest();
        if($request->isPost())
        {
            $milestone = $this->getServiceLocator()->get('milestone');
            $form->bind($milestone);
            $form->setData($request->getPost());
            if ($form->isValid())
            {
                // Persist.
                $em = $this->service->getEntityManager();
                $milestone->setProject($em->getReference('Project\Entity\Project', $id));
                $milestone->setStatus($em->getReference('Project\Entity\MilestoneStatus', 1));
                $milestone->setPriority($em->getReference('Project\Entity\MilestonePriority', 1));
                $this->service->persist($milestone);
                
                // Redirect.
                return $this->redirect()->toRoute('project/default',
                    array('controller' => 'project',
                          'action' => 'detail',
                          'id' => $id
		    ),
                    array('fragment' => 'milestones')
                );
            }
            
        }
        
        return new ViewModel(array(
            'form' => $form,
            'projectId' => $id
        ));
    }
    
    public function editAction()
    {
        // Get a current copy of the entity.
        $id = (int)$this->params()->fromRoute('id');
        if (!$id) {
            return $this->redirect()->toRoute('project/default', array('controller' => 'milestone', 'action'=>'add'));
	}
        $milestone = $this->service->findById($id);
        
        // Create a new form instance and bind the entity to it.
        $form = $this->getServiceLocator()->get('Project\MilestoneForm');
        $form->bind($milestone);
        
        // Check if this request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // Validate the data.
            $form->setData($request->getPost());
            if ($form->isValid())
            {
                // Save changes.
                $this->service->persist($milestone);

                // Redirect back to original referer.
                return $this->redirect()->toUrl($this->retrieveReferer());
            }
        }
        
        $this->storeReferer();
        
        return new ViewModel(array(
            'id' => $id,
            'form' => $form
        ));
    }
    
    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        $milestone = $this->service->findById($id);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            $projectId = $milestone->getProject()->getId();
            
            // Only perform delete if value posted was 'Yes'.
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $this->service->remove($milestone);
            }

            // Redirect to project detail
            return $this->redirect()->toRoute('project/default',
                array(
                    'controller' => 'project',
                    'action' => 'detail',
                    'id' => $projectId),
                array('fragment' => 'milestones')
            );
         }
         
        return new ViewModel(array(
            'milestone' => $milestone
        ));
    }
    
    public function detailAction()
    {
        // Get a current copy of the entity.
        $id = (int)$this->params()->fromRoute('id');
        if (!$id) {
            return $this->redirect()->toRoute('project/default', array('controller' => 'project'));
	}
        $milestone = $this->service->findById($id);
        
        return new ViewModel(array(
            'milestone' => $milestone
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
                $milestone = $em->find('Project\Entity\Milestone', $id);
                $milestone->addComment($comment);
                $em->persist($comment);
                $em->persist($milestone);
                $em->flush();
                
                // Redirect.
                return $this->redirect()->toUrl($this->retrieveReferer());
            }
            
        }
        
        $this->storeReferer('milestone\comment');
        
        return new ViewModel(array(
            'form' => $form,
            'projectId' => $id
        ));
    }
    
    private function storeReferer($except)
    {
        $referer = $this->getRequest()->getHeader('Referer')->uri()->getPath();
        if (strpos($referer, $except) === false) {
            $session = new Container('milestone');
            $session->referer = $referer;
        }
    }
    
    private function retrieveReferer()
    {
        $session = new Container('milestone');
        $referer = $session->referer;
        if (strpos($referer, 'project/detail') !== false) {
            $referer .= '#milestones';
        }
        return $referer;
    }
}