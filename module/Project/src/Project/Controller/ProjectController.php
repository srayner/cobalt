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
        return new ViewModel();
    }
    
    public function deleteAction()
    {
        return new ViewModel();
    }
}