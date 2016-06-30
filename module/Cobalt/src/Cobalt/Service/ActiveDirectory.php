<?php

namespace Cobalt\Service;

use Zend\Ldap\Ldap;
use Cobalt\Entity\User;
use Cobalt\Entity\Company;
use Cobalt\Entity\Office;
use Cobalt\Entity\Department;
use Cobalt\Entity\Computer;
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
            //die(var_dump($this->options));
            
            if ($item['samaccountname'][0] != '')
            {
                // Get existing user entity, or create new user entity.
                $user = $userService->findBySamAccountName($item['samaccountname'][0]);
                if (!$user) {
                    $user = new User();
                }
                
                // Set domain.
                $user->setDomain($this->options['accountDomainName']);
                
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
                
                // Company
                $company = null;
                if (array_key_exists('company', $item)){
                    $company = $this->companyService->findByName($item['company'][0]);
                    if (!$company) {
                        $company = new Company();
                        $company->setName($item['company'][0]);
                    }
                    $user->setCompany($company);
                }
                
                // Office
                if (array_key_exists('physicaldeliveryofficename', $item)) {
                    if (!$company) {
                        $company = new Company();
                        $company->setName('Unknown');
                    }
                    $office = $this->officeService->findByCompanyAndName($company, $item['physicaldeliveryofficename'][0]);
                    if (!$office) {
                        $office = new Office();
                        $office->setCompany($company);
                        $office->setName($item['physicaldeliveryofficename'][0]);
                    }
                    $user->setOffice($office);
                }
                
                // Department
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
    
    public function getComputers($computerService)
    {
        
        $domain = $this->options['accountDomainName'];
    
        $ldap = new Ldap($this->options);
        $ldap->bind();
        
        $result = $ldap->search('(&(objectCategory=computer))',
                             'dc=wr,dc=local',
                             Ldap::SEARCH_SCOPE_SUB);
        
        foreach ($result as $item)
        {
            if ($item['name'][0] != '') {
                
                $hostname = $item['name'][0];
                $computer = $computerService->findByDNSName($hostname, $domain);
                if (!$computer) {
                    $computer = new Computer();
                    $computer->setHostname($hostname)
                             ->setDomain($domain);
                }
                
                // Operating system
                if (array_key_exists('operatingsystem', $item)){
                    $computer->setOsName($item['operatingsystem'][0]);
                }
                
                // Operating system service pack
                if (array_key_exists('operatingsystemservicepack', $item)){
                    $computer->setOsServicePack($item['operatingsystemservicepack'][0]);
                }
                
                // Operating system version.
                if (array_key_exists('operatingsystemversion', $item)){
                    $computer->setOsVersion($item['operatingsystemversion'][0]);
                }
                
                $computerService->persist($computer);
                
            }
            
        }
        
    }
    
}