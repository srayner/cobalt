<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

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
}
