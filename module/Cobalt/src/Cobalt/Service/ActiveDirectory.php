<?php

namespace Cobalt\Service;

use Zend\Ldap\Ldap;
use Cobalt\Entity\User;
use Cobalt\Entity\Company;
use Cobalt\Entity\Office;
use Cobalt\Entity\Department;
use DateTime;

class ActiveDirectory {
    
    protected $options;
    protected $companyService;
    protected $officeService;
    protected $departmentService;
    
    public function __construct($companyService, $officeService, $departmentService)
    {
        $this->companyService    = $companyService;
        $this->officeService     = $officeService;
        $this->departmentService = $departmentService;
    }
    
    public function setOptions($options)
    {
        $this->options = $options;
    }
    
    public function getGroups()
    {
        
        $ldap = new Ldap($this->options);

        $ldap->bind();
        
        $result = $ldap->search('(groupType:1.2.840.113556.1.4.803:=2147483648)',
                             $this->options['baseDn'],
                             Ldap::SEARCH_SCOPE_SUB);
        
        foreach ($result as $item)
        {
             if ($item['samaccountname'][0] != '') {
                // Get existing entity, or create new entity.
                $adGroup = $adGroupService->findBySamAccountName($item['samaccountname'][0]);
                if (!$adGroup) {
                    $group = new AdGroup();
                }
            
                // Update group properties based on values from active directory.
                $adGroup->setSamAccountName($item['samaccountname'][0]);
                $adGroup->setDisplayname($item['name'][0]);
                if (array_key_exists('grouptype', $item)){
                    $adGroup ->setGroupType($item['grouptype'][0]);
                }
                
                $adGroupService->persist($adGroup);
             }
        }
    }
    
    public function getUsers($userService)
    {
        $ldap = new Ldap($this->options);
        $ldap->bind();
        
        $result = $ldap->search('(&(objectCategory=person)(objectClass=user))',
                             'dc=wr,dc=local',
                             Ldap::SEARCH_SCOPE_SUB);
        
        foreach ($result as $item)
        {
            
            if ($item['samaccountname'][0] != '')
            {
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
                    $user->setEmailAddress(strtolower($item['mail'][0]));
                }
                if (array_key_exists('othertelephone', $item)){    
                    $user->setTelephoneNumber($item['othertelephone'][0]);
                }
                if (array_key_exists('telephonenumber', $item)){
                    $user->setExtensionNumber($item['telephonenumber'][0]);
                }
                
                if (array_key_exists('mobile', $item)){
                    $user->setMobileNumber($item['mobile'][0]);
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
                    $company = $this->companyService->findByName($item['company'][0]);
                    if (!$company) {
                        $company = new Company();
                        $company->setName($item['company'][0]);
                    }
                    $user->setCompany($company);
                }
                if (array_key_exists('department', $item)){
                    $user->setDepartment($item['department'][0]);
                }
                if (array_key_exists('title', $item)){
                    $user->setTitle($item['title'][0]);
                }
                
                if (array_key_exists('badpasswordtime', $item)){
                    $fileTime = $item['badpasswordtime'][0];
                    $winSecs       = (int)($fileTime / 10000000); // divide by 10 000 000 to get seconds
                    $unixTimestamp = ($winSecs - 11644473600); // 1.1.1600 -> 1.1.1970 difference in seconds
                    $d = new DateTime();
                    $d->setTimestamp($unixTimestamp);
                    $user->setBadPasswordTime($d);
                }
                
                if (array_key_exists('badpwdcount', $item)){
                    $user->setBadPasswordCount($item['badpwdcount'][0]);
                }

                // Persist new data.
                $userService->persist($user);
            }
        }
    }
    
}