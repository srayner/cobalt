<?php

namespace Cobalt\Service;

class HardwareService extends AbstractEntityService
{
    public function count()
    {
        return $this->entityManager
                    ->createQuery('SELECT COUNT(h.id) FROM Cobalt\Entity\Hardware h')
                    ->getSingleScalarResult();
    }
    
    public function findByAssetNumber($assetNumber)
    {
        return $this->entityManager->getRepository($this->repository)
                                   ->findOneBy(array('assetNumber' => $assetNumber));
    }
    
    public function summaryByStatus()
    {
        $dql = 'SELECT s.name, COUNT(h.id) FROM Cobalt\Entity\Hardware h JOIN h.status s GROUP BY s.id';
        $query = $this->entityManager->createQuery($dql);
        return $query->getArrayResult();
    }
    
    public function summaryByType()
    {
        $dql = 'SELECT t.name, COUNT(h.id) FROM Cobalt\Entity\Hardware h JOIN h.type t GROUP BY t.id';
        $query = $this->entityManager->createQuery($dql);
        return $query->getArrayResult();
    }
    
    public function summaryByManufacturer()
    {
        $dql = 'SELECT m.id, m.name, COUNT(h.id) FROM Cobalt\Entity\Hardware h JOIN h.manufacturer m GROUP BY m.id';
        $query = $this->entityManager->createQuery($dql);
        return $query->getArrayResult();
    }
}
