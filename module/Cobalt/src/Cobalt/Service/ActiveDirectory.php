<?php

namespace Cobalt\Service;

use Zend\Ldap\Ldap;
use Cobalt\Model\User\User;

class ActiveDirectory {
    
    protected $options;
    
    public function setOptions($options)
    {
        $this->options = $options;
    }
    
    public function getUsers($userMapper)
    {
        $ldap = new Ldap($this->options);
        $ldap->bind();
        
        $result = $ldap->search('(&(objectCategory=person)(objectClass=user))',
                             'dc=wr,dc=local',
                             Ldap::SEARCH_SCOPE_SUB);
        
        foreach ($result as $item) {
            
            // Get existing user entity, or create new user entity.
            $user = $userMapper->getUserBySamAccountName($item['samaccountname'][0]);
            if (!$user) {
                $user = new User();
            }
            
            // Update user properties based on values from active directory.
            $user->setSamAccountName($item['samaccountname'][0]);
            $user->setUsername($item['samaccountname'][0]);
            if (array_key_exists('userprincipalname', $item)){
                $user ->setUserPrincipalName($item['userprincipalname'][0]);
            }
            if (array_key_exists('mail', $item)){    
                $user->setEmail(strtolower($item['mail'][0]));
            }
            if (array_key_exists('othertelephone', $item)){    
                $user->setTelephoneNumber($item['othertelephone'][0]);
            }
            if (array_key_exists('telephonenumber', $item)){
                $user->setExtensionNumber($item['telephonenumber'][0]);
            }
            if (array_key_exists('displayname', $item)){
                $user->setDisplayName($item['displayname'][0]);
            }
            if (array_key_exists('description', $item)){
                $user->setDescription(substr($item['description'][0], 0, 64));
            }
            if (array_key_exists('physicaldeliveryofficename', $item)){
                $user->setOffice($item['physicaldeliveryofficename'][0]);
            }
            
            // Persist new data.
            $userMapper->persist($user);
            
        }
    }
    
}