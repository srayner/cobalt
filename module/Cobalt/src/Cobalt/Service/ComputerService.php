<?php

namespace Cobalt\Service;

class ComputerService extends AbstractEntityService
{   
    public function count()
    {
        return $this->entityManager
                    ->createQuery('SELECT COUNT(c.id) FROM Cobalt\Entity\Computer c')
                    ->getSingleScalarResult();
    }

    public function findBySerial($serial)
    {
        return $this->entityManager->getRepository($this->repository)
                                   ->findOneBy(array('serialNumber' => $serial));
    }
    
    public function findByDNSName($hostname, $domain)
    {
        return $this->entityManager->getRepository($this->repository)
                ->findOneBy(array('hostname' => $hostname, 'domain' => $domain));
    }

    public function setType($computer, $typeName)
    {
        $type = $this->entityManager->getRepository('Cobalt\Entity\HardwareType')->findOneBy(array(
            'name' => $typeName
        ));
        $computer->setType($type);
    }
}

