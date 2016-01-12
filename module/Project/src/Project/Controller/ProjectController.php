<?php

namespace Project\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ProjectController extends AbstractActionController
{
    public function indexAction()
    {
        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $projects = $objectManager->getRepository('Project\Entity\Project')->findAll();
        
        return new ViewModel(array(
            'projects' => $projects    
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
                $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
                $objectManager->persist($project);
                $objectManager->flush();
                
                // Redirect.
                return $this->redirect()->toRoute('project/default', array(
                    'controller' => 'project',
		    'action'     => 'index'
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
        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $project = $entityManager->find('Project\Entity\Project', $id);
        
        // Create a new form instance and bind the entity to it.
        $form = $this->getServiceLocator()->get('project_form');
        $form->bind($project);
        $form->get('submit')->setAttribute('label', 'Edit');

        // Check if this request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // Validate the data.
            $form->setData($request->getPost());
            if ($form->isValid())
            {
                $entityManager->persist($project);
                $entityManager->flush();

                // Create information message.
                $this->flashMessenger()->addMessage('Project ' . $project->getName() . ' successfully updated');

                // Redirect to list of projects
                return $this->redirect()->toRoute('project/default', array('controller' => 'project'));
            }
        }
		
	// Render (or re-render) the form.
	return array(
            'id' => $id,
            'form' => $form,
        );
    }
    
    public function deleteAction()
    {
        return new ViewModel();
    }
}