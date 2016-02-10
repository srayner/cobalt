<?php

namespace Cobalt\Service;

use Zend\Ldap\Ldap;
use Cobalt\Entity\User;

class ActiveDirectory {
    
    protected $options;
    
    public function setOptions($options)
    {
        $this->options = $options;
    }
    
    public function getUsers($userService)
    {
        $ldap = new Ldap($this->options);
        $ldap->bind();
        
        $result = $ldap->search('(&(objectCategory=person)(objectClass=user))',
                             'dc=wr,dc=local',
                             Ldap::SEARCH_SCOPE_SUB);
        
        foreach ($result as $item) {
            
            if ($item['samaccountname'][0] != '') {
                // Get existing user entity, or create new user entity.
                $user = $userService->findBySamAccountName($item['samaccountname'][0]);
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

                if (array_key_exists('company', $item)){
                    $user->setCompany($item['company'][0]);
                }
                if (array_key_exists('department', $item)){
                    $user->setDepartment($item['department'][0]);
                }
                if (array_key_exists('title', $item)){
                    $user->setTitle($item['title'][0]);
                }

                // Persist new data.
                $userService->persist($user);
            }
        }
    }
    
}