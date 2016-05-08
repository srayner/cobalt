<?php

namespace Cobalt\Service;

class HardwareManufacturerService extends AbractEntityService
{
    public function findByName($name)
    {
        return $this->entityManager->getRepository($this->repository)
                                   ->findOneBy(array('name' => $name));
    }
    
}

