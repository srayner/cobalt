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
        if ($this->authService->hasIdentity()) {
            return $this->view->partial('application/partial/profile_menu.phtml', array(
                'displayName' => $this->authService->getIdentity()->getDisplayName()
            ));
        }
        return '<a class="btn btn-sm btn-primary" href="/login">Login</a>';
    }
}
