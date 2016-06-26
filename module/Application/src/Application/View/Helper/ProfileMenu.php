<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

class ProfileMenu extends AbstractHelper
{
    protected $authService;
    
    public function __construct($authService)
    {
        $this->authService = $authService;
    }
    
    public function __invoke()
    {
        $hasIdentity = 'No';
        if ($this->authService->hasIdentity()) 
        {
            $hasIdentity = 'Yes';
        }
        return $hasIdentity;        
    }
}
