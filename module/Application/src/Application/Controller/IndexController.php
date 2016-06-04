<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Config\Config;
use Zend\Config\Writer\PhpArray as Writer;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $service = $this->getServiceLocator()->get('cobalt_computer_service');
        $count = $service->count();
        return array(
            'computers' => $count
        );
    }
    
    public function adminAction()
    {
        return new ViewModel();
    }
    
    public function consoleAction()
    {
        $path = "\\\\srv006\\public\\logins\\";
        $file = 'am2@URN2307.log';
        
        $handle = fopen($path . $file, "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                // process the line read.
                $data = explode(':', $line);
                echo $data[0] . PHP_EOL;
                if ($data[0] == 'User Name') {
                    echo "got user name";
                }
            }
            fclose($handle);
        } else {
            // error opening the file.
        }  
    }
    
    public function dbconfigAction()
    {
        // Create a new form.
        $form = $this->getServiceLocator()->get('Application\DbConfigForm');
         
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
                $writer = new Writer();
                $writer->toFile('config/database.config.php', $config);
                
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
                $writer = new Writer();
                $writer->toFile('config/activedirectory.config.php', $config);
                
            	// Redirect to admin index page
		return $this->redirect()->toRoute('admin');
            }
        } 
        
        // If not a POST request, or invalid data, then just render the form.
        return new ViewModel(array(
            'form'   => $form
        ));
    }
    
    public function templateAction()
    {
        $form = $this->getServiceLocator()->get('Application\TemplateForm');
        $template = file_get_contents('data/templates/new_ticket');
        $data = array('template' => $template);
        $form->setData($data);
        
        $request = $this->getRequest();
        if ($request->isPost())
        {    
            // Validate the data.
            $form->setData($request->getPost());
            if ($form->isValid())
            {
                // persist template
                $data = $form->getData();
                $template = $data['template'];
                file_put_contents('data/templates/new_ticket', $template);
            }
            
            // Redirect to admin (for now)
            $this->redirect()->toRoute('admin');
        }
            
        return array(
            'form' => $form
        );

    }
}
