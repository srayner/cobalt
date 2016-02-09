<?php

namespace Project\Controller;

use Zend\View\Model\ViewModel;

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

                // Redirect to list of projects
                return $this->redirect()->toRoute('project/default', array(
                    'controller' => 'project',
                    'action' => 'detail',
                    'id' => $id
                ));
            }
        }
		
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
}