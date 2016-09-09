<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Session\Container;
use Cobalt\Entity\Role;

class UserController extends AbstractController
{   
    public function adupdateAction()
    {   
        $adService = $this->getServiceLocator()->get('Cobalt\ActiveDirectoryService');
        $adService->getUsers($this->service);
    
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
        // Ensure we have an id, else redirect to index action.
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('cobalt/default', array('controller' => 'user'));
        }
        
        // Grab a copy of the user object.
        $user = $this->service->findById($id);
        
        // Get this history for this object.
        $historyService = $this->getServiceLocator()->get('Cobalt\HistoryService');
        $history = $historyService->find(1, $user->getID());
        
        // Return the object and history to the view.
        return new ViewModel(array(
            'user'    => $user,
            'history' => $history
        ));
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
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
          
            // Create a new user object.
            $user = $this->getServiceLocator()->get('Cobalt\User');
            
            $form->bind($user);
            $form->setData($data);
            if ($form->isValid())
            {
          	// Persist user.
                $user->setDomain('local');
            	$this->service->persist($user);
                
            	// Redirect to list of users
		return $this->redirect()->toRoute('cobalt/default', array(
                    'controller' =>'user'
		));
            }
        } 
        
        // If not a POST request, or invalid data, then just render the form.
        return new ViewModel(array(
            'form'   => $form,
        ));
    }
    
    public function editAction()
    {
        
        // Check we have an id, otherwise redirect to add action.
        $id = (int)$this->params()->fromRoute('id');
        if (!$id) {
            return $this->redirect()->toRoute('cobalt/default', array('controller' => 'user', 'action'=>'add'));
	}
        
        // Create a new form instance and bind the entity to it.
        $user = $this->service->findById($id);
        $form = $this->getServiceLocator()->get('Cobalt\UserForm');
        $form->remove('password');
        $form->bind($user);

        // Check if this request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // Validate the data.
            $form->setData($request->getPost());
            if ($form->isValid())
            {
                // Persist to database.
                $this->service->persist($user);

                // Redirect to list of users
                return $this->redirect()->toRoute('cobalt/default', array('controller' => 'user'));
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
            return $this->redirect()->toRoute('cobalt/default', array('controller' => 'user'));
        }
        
        $user = $this->service->findById($id);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            // Only perform delete if value posted was 'Yes'.
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                
                // Remove user.
                $this->service->remove($user);
                
                // Redirect to list of users.
                return $this->redirect()->toRoute('cobalt/default', array('controller' => 'user'));
            }

            // Redirect back to original referer.
            return $this->redirect()->toUrl($this->retrieveReferer());
            
        }
        
        $this->storeReferer('user/delete');
        
        return new ViewModel(array(
            'user' => $user
        ));
    }
    
    public function relationshipsAction()
    {
        // Ensure we have an id, else redirect to index action.
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('cobalt/default', array('controller' => 'user'));
        }
        
        $user = $this->service->findById($id);
        $reportsTo = $user->getReportsTo();
        
        return array(
            'user' => $user,
            'reportsTo' => $reportsTo
        );
    }
    
    public function addroleAction()
    {
        // Ensure we have an id, else redirect to index action.
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('cobalt/default', array('controller' => 'user'));
        }
        
        // Grab the user
        $user = $this->service->findById($id);
        
        $aclService = $this->getServiceLocator()->get('CivAccess\AclService');
        $roles = $aclService->getRoles();
        
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // Validate data
            $roleName = $request->getPost('role');
            
            
            // Persist
            $role = new Role;
            $role->setName($roleName)
                 ->setType('User role.');
            $user->addRole($role);
            $this->service->persist($user);
            
            // Redirect
            $this->redirect()->toRoute('cobalt/default', array(
                'controller' => 'user',
                'action'     => 'detail',
                'id'         => $id
            ), array('fragment'=>'roles'));
        }
        
        return array(
            'user' => $user,
            'roles' => $roles
        );
    }
    
    public function removeroleAction()
    {
        // Ensure we have an id, else redirect to user index action.
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('cobalt/default', array('controller' => 'user'));
        }
        
        $service = $this->getServiceLocator()->get('CivAccess\AclService');
        $role = $service->getRoleById($id);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
        
            // Only perform delete if value posted was 'Yes'.
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $service = $this->getServiceLocator()->get('CivAccess\AclService');
                $service->deleteRoleById($id);
            }
            
            // Redirect to list of users
            return $this->redirect()->toRoute('cobalt/default', array('controller' => 'user'));
        }
        
        return new ViewModel(array(
            'role' => $role 
        ));
    }
    
    public function addhardwareAction()
    {
        // Ensure we have an id, else redirect to index action.
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('cobalt/default', array('controller' => 'user'));
        }
        
        // Grab the user
        $user = $this->service->findById($id);
        
        $hardwareService = $this->getServiceLocator()->get('CivAccess\EntityService\HardwareService');
        $hardware = $hardwareService->findAll();
        
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // TODO: Validate data
            $hardwareId = $request->getPost('hardware');
            
            // Persist
            $h = $hardwareService->findById($hardwareId);
            $user->addHardware($h);
            $this->service->persist($user);
            
            // Redirect
            $this->redirect()->toRoute('cobalt/default', array(
                'controller' => 'user',
                'action'     => 'detail',
                'id'         => $id
            ), array('fragment'=>'hardware'));
        }
        
        return array(
            'user' => $user,
            'hardware' => $hardware
        );
        
    }
    
    public function removehardwareAction()
    {
        // Extract identifiers from route param.
        $params = explode('_', $this->params()->fromRoute('id'));
        $userId = $params[0];
        $hardwareId = $params[1];
        
        $hardwareService = $this->getServiceLocator()->get('Cobalt\EntityService\HardwareService');
        $hardware = $hardwareService->findById($hardwareId);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
        
            // Only perform delete if value posted was 'Yes'.
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                
                $user = $this->service->findById($userId);
                $user->removeHardware($hardware);
                $hardwareService->persist($hardware);
            }
            
            // Redirect to list of users
            return $this->redirect()->toRoute('cobalt/default', array(
                'controller' => 'user',
                'action' => 'detail',
                'id' => $userId
            ), array('fragment'=>'hardware'));
        }
        
        return new ViewModel(array(
            'userId' => $userId,
            'hardware' => $hardware 
        ));
    }
    
    public function techniciansAction()
    {
        return array(
            'users' => $this->service->findTechnicians()
        );   
    }
    
    public function findAction()
    {
        $search = '%' . $this->params()->fromRoute('id', '') . '%';
        $users = $this->service->search($search);
        return new JsonModel(array(
            'users' => $users 
        ));
    }
    
    private function storeReferer($except)
    {
        $referer = $this->getRequest()->getHeader('Referer')->uri()->getPath();
        if (strpos($referer, $except) === false) {
            $session = new Container('user');
            $session->referer = $referer;
        }
    }
    
    private function retrieveReferer()
    {
        $session = new Container('user');
        $referer = $session->referer;
        return $referer;
    }
}