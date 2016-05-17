<?php

namespace Cobalt\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ActiveDirectoryServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $companyService    = $serviceLocator->get('Cobalt\EntityService\CompanyService');
        $officeService     = $serviceLocator->get('Cobalt\EntityService\OfficeService');
        $departmentService = $serviceLocator->get('Cobalt\EntityService\DepartmentService');
        
        $service = new ActiveDirectory($companyService, $officeService, $departmentService);
        $options = $serviceLocator->get('Config')['cobalt']['ldap'];
        $service->setOptions($options);
        return $service;
    } 
}

