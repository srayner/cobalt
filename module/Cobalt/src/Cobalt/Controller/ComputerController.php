<?php

namespace Cobalt\Controller;

class ComputerController extends AbstractController
{
    public function indexAction()
    {
        $computers = $this->getEntityManager()->getRepository('Cobalt\Entity\Computer')->findAll();
        return array(
            'computers' => $computers
        );
    }
    
    public function detailAction()
    {
        // Ensure we have an id, else redirect to index action.
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
             return $this->redirect()->toRoute('cobalt/default', array(
                 'controller' => 'computer',
             ));
        }
        
        $computer = $this->getEntityManager()->find('Cobalt\Entity\Computer', $id);
        return array(
            'computer' => $computer,
        );
    }
    
    public function addAction()
    {
        // Create a new form.
        $form = $this->getServiceLocator()->get('Cobalt\ComputerForm');
         
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
          
            // Create a new computer object.
            $computer = $this->getServiceLocator()->get('Cobalt\Computer');
            
            $form->bind($computer);
            $form->setData($data);
            if ($form->isValid())
            {
          	// Persist computer.
            	$this->getEntityManager()->persist($computer);
                $this->getEntityManager()->flush();
                
            	// Redirect to list of computers
		return $this->redirect()->toRoute('cobalt/default', array(
		    'controller' => 'computer',
                    'action'     => 'index'
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
        // Ensure we have an id, else redirect to add action.
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
             return $this->redirect()->toRoute('cobalt/default', array(
                 'controller' => 'computer',
                 'action' => 'add'
             ));
        }
        
        // Grab the computer with the specified id.
        $computer = $this->getEntityManager()->find('Cobalt\Entity\Computer', $id);
        
        $form = $this->getServiceLocator()->get('Cobalt\ComputerForm');
        $form->bind($computer);
        $form->get('submit')->setAttribute('value', 'Edit');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
        
            $form->setData($request->getPost());
            if ($form->isValid()) {
                
                // Persist computer.
            	$this->getEntityManager()->persist($computer);
                $this->getEntityManager()->flush();
                
                // Redirect to list of computers
                return $this->redirect()->toRoute('cobalt/default', array(
                    'controller' => 'computer'
                ));
            }     
        }
        
        return array(
             'id' => $id,
             'form' => $form,
        );   
    }
}