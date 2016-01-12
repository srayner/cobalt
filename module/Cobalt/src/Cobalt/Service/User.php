<?php

namespace Cobalt\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
        
class User implements ServiceManagerAwareInterface
{
    /**
     * @var ServiceManager
     */
    protected $serviceManager;
    
    /**
     * @var UserMapperInterface
     */
    protected $userMapper;
    
    /**
     * Retrieve service manager instance
     *
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }
    
    /**
     * Set service manager instance
     *
     * @param ServiceManager $serviceManager
     * @return User
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }
    
    public function setUserMapper($mapper)
    {
        $this->userMapper = $mapper;
        return $this;
    }
    
    public function getUsers()
    {
        return $this->userMapper->getUsers();
    }
    
    public function getUserById($userId)
    {
        return $this->userMapper->getUserById($userId);
    }
    
    public function getUserBySamAccountName($samAccountName)
    {
        return $this->userMapper->getUserBySamAccountName($samAccountName);
    }
    
    public function persistUser($user)
    {
        $this->userMapper->persist($user);
    }
    
    public function count($search = null)
    {
        return $this->userMapper->count($search);
    }
}