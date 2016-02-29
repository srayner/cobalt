<?php

namespace Cobalt\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use DateTime;

class DomainController extends AbstractController
{
    public function indexAction()
    {
        return new ViewModel(array(
            'domains' => $this->service->findAll()
        ));
    }
    
    public function addAction()
    {
        // Create new form and hydrator instances.
        $form = $this->getServiceLocator()->get('Cobalt\DomainForm');
         
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
          
            // Create a new domain object.
            $domain = $this->getServiceLocator()->get('Cobalt\Domain');
            
            $form->bind($domain);
            $form->setData($data);
            if ($form->isValid())
            {
          	// Persist domain.
            	$this->service->persist($domain);
                
            	// Redirect to list of domains
		return $this->redirect()->toRoute('cobalt/default', array(
                    'controller' =>'domain'
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
        // Ensure we have an id, else redirect to add action.
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
             return $this->redirect()->toRoute('cobalt/default', array(
                 'controller' => 'domain',
                 'action' => 'add'
             ));
        }
        
        // Grab the domain with the specified id.
        $domain = $this->service->findById($id);
        
        $form = $this->getServiceLocator()->get('Cobalt\DomainForm');
        $form->bind($domain);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
        
            $form->setData($request->getPost());
            if ($form->isValid()) {
                
                // Persist domain.
            	$this->service->persist($domain);
                
                // Redirect back to original referer.
                return $this->redirect()->toUrl($this->retrieveReferer());
            }     
        }
        
        $this->storeReferer('domain/edit');
        
        return new ViewModel(array(
             'id' => $id,
             'form' => $form,
        ));
    }
    
    public function detailAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $domain = $this->service->findById($id);
        return new ViewModel(array(
            'domain' => $domain,
        ));
    }
    
    public function refreshAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $domain = $this->service->findById($id);
        $whois = $this->getServiceLocator()->get('WhoisService');
        $result = $whois->lookup($domain->getName());
        
        $domainResult = $result['regrinfo'];
        $registryResult = $result['regyinfo'];
        
        die(var_dump($result['rawdata']));
        
        if (array_key_exists('registrar', $registryResult)) {
            $domain->setRegistrar($registryResult['registrar']);
        }
        
        if (array_key_exists('referrer', $registryResult)) {
            $domain->setRegistrarUrl($registryResult['referrer']);
        }
        
        if (array_key_exists('owner', $domainResult)) {
            
            if (array_key_exists('organization', $domainResult['owner'])) {
                $domain->setRegistrant($domainResult['owner']['organization']);
            }
            
            if (array_key_exists('address', $domainResult['owner'])) {
                $domain->setRegistrantAddress($this->getMultiValue($domainResult['owner']['address']));
            }
            
        }
        
        if (array_key_exists('domain', $domainResult)) {
            
            if (array_key_exists('status', $domainResult['domain'])) {
                $domain->getStatuses()->clear();
                foreach($domainResult['domain']['status'] as $s)
                {
                    $status = $this->getServiceLocator()->get('Cobalt\DomainStatus');
                    $status->setStatus($s);
                    $status->setDomain($domain);
                    $domain->addStatus($status);
                    $this->service->persist($status);
                }
                
            }
            
            if (array_key_exists('nserver', $domainResult['domain'])) {
                $domain->getNameServers()->clear;
                foreach($domainResult['domain']['nserver'] as $key=>$value) {
                    
                }
                
            }
            
            if (array_key_exists('created', $domainResult['domain'])) {
                $created = DateTime::CreateFromFormat('Y-m-d', $domainResult['domain']['created']);
                $domain->setCreated($created);
            }
            
            if (array_key_exists('changed', $domainResult['domain'])) {
                $changed = DateTime::CreateFromFormat('Y-m-d', $domainResult['domain']['changed']);
                $domain->setChanged($changed);
            }
            
            if (array_key_exists('expires', $domainResult['domain'])) {
                $expires = DateTime::CreateFromFormat('Y-m-d', $domainResult['domain']['expires']);
                $domain->setExpires($expires);
            }
        }
        
        $this->service->persist($domain);
        
        return $this->redirect()->toRoute('cobalt/default', array('controller' => 'domain'));
    }
    
    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        $domain = $this->service->findById($id);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            // Only perform delete if value posted was 'Yes'.
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $this->service->remove($domain);
            }

            // Redirect to domain index
            return $this->redirect()->toRoute('cobalt/default',
                array('controller' => 'domain'));
         }
         
        return new ViewModel(array(
            'domain' => $domain
        ));
    }
    
    private function getMultiValue(array $lines)
    {
        $result = '';
        foreach($lines as $line) {
            if (strpos($line, 'Data validation:') !== false) {
                break;
            } else {
                $result .= $line . '<br>';
            }
        }
        return $result;
    }
    
    private function storeReferer($except)
    {
        $referer = $this->getRequest()->getHeader('Referer')->uri()->getPath();
        if (strpos($referer, $except) === false) {
            $session = new Container('domain');
            $session->referer = $referer;
        }
    }
    
    private function retrieveReferer()
    {
        $session = new Container('domain');
        $referer = $session->referer;
        return $referer;
    }
}
