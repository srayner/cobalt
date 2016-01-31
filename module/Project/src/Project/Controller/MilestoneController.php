<?php

namespace Project\Controller;

use Zend\View\Model\ViewModel;

class MilestoneController extends AbstractController
{
    public function indexAction()
    {
        return new ViewModel();
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