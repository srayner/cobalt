<?php

namespace Project\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class CommentController extends AbstractController
{   
    public function editAction()
    {
        // Get a current copy of the entity.
        $id = (int)$this->params()->fromRoute('id');
        $comment = $this->service->findById($id);
         
        // Create a new form instance and bind the entity to it.
        $form = $this->getServiceLocator()->get('Project\CommentForm');
        $form->bind($comment);
        
        // Check if this request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // Validate the data.
            $form->setData($request->getPost());
            if ($form->isValid())
            {
                // Save changes.
                $this->service->persist($comment);

                // Redirect back to original referer.
                return $this->redirect()->toUrl($this->retrieveReferer());
            }
        }
        
        $this->storeReferer('comment/edit');
        
        return new ViewModel(array(
            'id' => $id,
            'form' => $form
        ));
    }
    
    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        $comment = $this->service->findById($id);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            // Only perform delete if value posted was 'Yes'.
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $this->service->remove($comment);
            }

            // Redirect to original referer.
            return $this->redirect()->toUrl($this->retrieveReferer());
            
        }
        
        // Store referer
        $this->storeReferer('comment/delete');
        
        return new ViewModel(array(
            'comment' => $comment
        ));
    }
    
    private function storeReferer($except)
    {
        $referer = $this->getRequest()->getHeader('Referer')->uri()->getPath();
        if (strpos($referer, $except) === false) {
            $session = new Container('comment');
            $session->referer = $referer;
        }
    }
    
    private function retrieveReferer()
    {
        $session = new Container('comment');
        return  $session->referer;
    }
}