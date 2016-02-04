<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;

class UserController extends AbstractController
{   
    public function adupdateAction()
    {
        $dbMapper = $this->getServiceLocator()->get('cobalt_user_mapper');
        
        $adService = $this->getServiceLocator()->get('cobalt_active_directory_service');
        $adService->getUsers($dbMapper);
    
        return array();
    }
    
    public function indexAction()
    {
        return new ViewModel(array(
            'users' => $this->service->findAll()
        ));
    }
    
    public function detailAction()
    {
        $userId = $this->params()->fromRoute('id');
        $user = $this->getUserService()->getUserById($userId);
        return array(
            'user' => $user,
        );
    }
    
    public function addAction()
    {
        // Create new form and hydrator instances.
        $form = $this->getServiceLocator()->get('Cobalt\UserForm');
         
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
          
            // Create a new user object.
            $user = $this->getServiceLocator()->get('Cobalt\User');
            
            $form->bind($user);
            $form->setData($data);
            if ($form->isValid())
            {
          	// Persist user.
            	$this->service->persist($user);
                
            	// Redirect to list of users
		return $this->redirect()->toRoute('cobalt/default', array(
                    'controller' =>'user'
		));
            }
        } 
        
        // If not a POST request, or invalid data, then just render the form.
        return array(
            'form'   => $form,
        );
    }
    
    public function editAction()
    {
        
    }
    
    public function deleteAction()
    {
        
    }
}