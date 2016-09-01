<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Config\Config;
use Zend\Config\Writer\PhpArray as Writer;

class IndexController extends AbstractActionController
{
    public function adminAction()
    {
        return new ViewModel();
    }
    
    public function dbconfigAction()
    {
        // Create a new form.
        $form = $this->getServiceLocator()->get('Application\DbConfigForm');
        $filename = 'config/database.config.php';
        $this->loadConfig($filename, $form);
        
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
          
            $form->setData($data);
            if ($form->isValid())
            {
          	// Convert to  config object.
            	$config = new Config(array(), true);
                $config->hostname = $data['hostname'];
                $config->database = $data['database'];
                $config->username = $data['username'];
                $config->password = str_rot13($data['password']);
                
                // Persist to file system.
                $this->saveConfig($filename, $config);
                
            	// Redirect to admin index page
		return $this->redirect()->toRoute('admin');
            }
        } 
        
        // If not a POST request, or invalid data, then just render the form.
        return new ViewModel(array(
            'form'   => $form
        ));
    }
    
    public function adconfigAction()
    {
        // Create a new form.
        $form = $this->getServiceLocator()->get('Application\AdConfigForm');
        $filename = 'config/activedirectory.config.php';
        $this->loadConfig($filename, $form);
        
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
          
            $form->setData($data);
            if ($form->isValid())
            {
          	// Convert to  config object.
            	$config = new Config(array(), true);
                $config->domain_name       = $data['domain_name'];
                $config->domain_name_short = $data['domain_name_short'];
                $config->domain_controller = $data['domain_controller'];
                $config->ldap_port         = $data['ldap_port'];          
                $config->user              = $data['user'];
                $config->password          = str_rot13($data['password']);
                $config->use_start_tls     = $data['use_start_tls'];
                $config->baseDn            = $data['baseDn'];
   
                // Persist to file system.
                $this->saveConfig($filename, $config);
                
            	// Redirect to admin index page
		return $this->redirect()->toRoute('admin');
            }
        } 
        
        // If not a POST request, or invalid data, then just render the form.
        return new ViewModel(array(
            'form'   => $form
        ));
    }
    
    public function mailinconfigAction()
    {
        // Create a new form.
        $form = $this->getServiceLocator()->get('Application\MailServerForm');
        $filename = 'config/mailin.config.php';
        $this->loadConfig($filename, $form);
        
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
            
            $form->setData($data);
            if ($form->isValid())
            {
          	// Convert to  config object.
            	$config = new Config(array(), true);
                $config->name = $data['name'];
                $config->host = $data['host'];
                $config->port = $data['port'];
                $config->ssl = $data['ssl'];
                $config->username = $data['username'];
                $config->password = str_rot13($data['password']);
                
                // Persist to file system.
                $this->saveConfig($filename, $config);
                
            	// Redirect to admin index page
		return $this->redirect()->toRoute('admin');
            }
        }
            
        return array(
            'form' => $form
        );
    }
    
    public function mailoutconfigAction()
    {
        // Create a new form.
        $form = $this->getServiceLocator()->get('Application\MailServerForm');
        $filename = 'config/mailout.config.php';
        $this->loadConfig($filename, $form);
        
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
            
            $form->setData($data);
            if ($form->isValid())
            {
          	// Convert to  config object.
            	$config = new Config(array(), true);
                $config->name = $data['name'];
                $config->host = $data['host'];
                $config->port = $data['port'];
                $config->ssl = $data['ssl'];
                $config->username = $data['username'];
                $config->password = str_rot13($data['password']);
                
                // Persist to file system.
                $this->saveConfig($filename, $config);
                
            	// Redirect to admin index page
		return $this->redirect()->toRoute('admin');
            }
        }
            
        return array(
            'form' => $form
        );
    }
            
    public function helpAction()
    {
        return array();
    }
    
    public function settingsAction()
    {
        return array();
    }
    
    private function loadConfig($filename, $form)
    {
        $config = null;
        if (file_exists($filename)) {
            $config = include $filename;
        }
        if (is_array($config)) {
            unset($config['password']);
            $form->setData($config);
        }
    }
    
    private function saveConfig($filename, $config)
    {
        $writer = new Writer();
        $writer->toFile($filename, $config);
        opcache_invalidate($filename);
    }
}
