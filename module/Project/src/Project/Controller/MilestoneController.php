<?php

namespace Project\Controller;

use Zend\View\Model\ViewModel;

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
        return new ViewModel();
    }
    
    public function deleteAction()
    {
        return new ViewModel();
    }
}