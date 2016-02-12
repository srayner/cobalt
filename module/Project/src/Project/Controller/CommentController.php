<?php

namespace Project\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class CommentController extends AbstractController
{
    public function addAction()
    {   
        $form = $this->getServiceLocator()->get('Project\CommentForm');
        $request = $this->getRequest();
        if($request->isPost())
        {
            $comment = $this->getServiceLocator()->get('Project\Comment');
            $form->bind($comment);
            $form->setData($request->getPost());
            if ($form->isValid())
            {
                // Persist.
                $this->service->persist($comment);
                
                // Redirect.
                return $this->redirect()->toUrl($this->retrieveReferer());
            }
            
        }
        
        $this->storeReferer();
        
        return new ViewModel(array(
            'form' => $form,
            'projectId' => $id
        ));
    }
    
    public function editAction()
    {
        return new ViewModel(array(
            
        ));
    }
    
    public function deleteAction()
    {
        return new ViewModel(array(
            
        ));
        
    }
    
    private function storeReferer()
    {
        $referer = $this->getRequest()->getHeader('Referer')->uri()->getPath();
        if (strpos($referer, 'comment/edit') === false) {
            $session = new Container('comment');
            $session->referer = $referer;
        }
        
    }
    
    private function retrieveReferer()
    {
        $session = new Container('comment');
        return $session->referer;
    }
}