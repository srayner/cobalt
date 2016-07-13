<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Session\Container;

class HardwareController extends AbstractController
{
    public function indexAction()
    {
        $hardware = $this->service->findAll();
        
        return new ViewModel(array(
            'hardware' => $hardware
        ));
    }
    
    public function addAction()
    {
        // Create a new form.
        $form = $this->getServiceLocator()->get('Cobalt\HardwareForm');
         
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
          
            // Create a new hardware object.
            $hardware = $this->getServiceLocator()->get('Cobalt\Hardware');
            
            $form->bind($hardware);
            $form->setData($data);
            if ($form->isValid())
            {
          	// Persist hardware.
            	$this->service->persist($hardware);
                
            	// Redirect to list of hardware
		return $this->redirect()->toRoute('cobalt/default', array(
		    'controller' => 'hardware',
                    'action'     => 'index'
		));
            }
        } 
        
        // If not a POST request, or invalid data, then just render the form.
        return new ViewModel(array(
            'form'   => $form
        ));
    }
    
    public function editAction()
    {
        // Get a current copy of the entity.
        $id = (int)$this->params()->fromRoute('id');
        if (!$id) {
            return $this->redirect()->toRoute('cobalt/default', array('controller' => 'hardware', 'action'=>'add'));
	}
        $hardware = $this->service->findById($id);
        
        // Create a new form instance and bind the entity to it.
        $form = $this->getServiceLocator()->get('Cobalt\HardwareForm');
        $form->bind($hardware);
        
        // Check if this request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // Validate the data.
            $form->setData($request->getPost());
            if ($form->isValid())
            {
                // Save changes.
                $this->service->persist($hardware);

                // Redirect back to original referer.
                return $this->redirect()->toUrl($this->retrieveReferer());
            }
        }
        
        $this->storeReferer('hardware/edit');
        
        return new ViewModel(array(
            'id' => $id,
            'form' => $form
        ));
    }
    
    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        $hardware = $this->service->findById($id);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            // Only perform delete if value posted was 'Yes'.
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $this->service->remove($hardware);
            
                // Redirect to manufacturer index
                return $this->redirect()->toRoute('cobalt/default',
                    array('controller' => 'hardware'));
            }
            
            // Redirect back to original referer
            return $this->redirect()->toUrl($this->retrieveReferer());
        }
        
        $this->storeReferer('hardware/delete');
        
        return new ViewModel(array(
            'hardware' => $hardware
        ));
    }
    
    public function detailAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $hardware = $this->service->findById($id);
        
        return new ViewModel(array(
            'hardware' => $hardware
        ));
        
    }
    
    public function summaryAction()
    {
        $summary = $this->service->summaryByStatus();
        return new ViewModel(array(
            'summary' => $summary
        ));
    }
    
    private function storeReferer($except)
    {
        $referer = $this->getRequest()->getHeader('Referer')->uri()->getPath();
        if (strpos($referer, $except) === false) {
            $session = new Container('hardware');
            $session->referer = $referer;
        }
    }
    
    private function retrieveReferer()
    {
        $session = new Container('hardware');
        $referer = $session->referer;
        return $referer;
    }
    
    public function uploadimageAction()
    {
        
        $filename = $this->request->getHeader('HTTP_X_FILENAME');
        die(var_dump($filename));
        
	// AJAX call
	file_put_contents(
		'public/cobalt/computer/gravatar.jpg',
		file_get_contents('php://input')
	);
	
	


        $variables = array(
            'result' => 'ok',
        );
        $view = new JsonModel($variables);
        return $view;
    }
}
