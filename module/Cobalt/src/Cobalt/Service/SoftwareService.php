<?php

namespace Cobalt\Service;

class SoftwareService extends AbstractEntityService
{
    public function summaryByType()
    {
        $dql = 'SELECT t.name, COUNT(s.id) FROM Cobalt\Entity\Software s JOIN s.type t GROUP BY t.id';
        $query = $this->entityManager->createQuery($dql);
        return $query->getArrayResult();
    }
    
    public function summaryByCategory()
    {
        $dql = 'SELECT c.name, COUNT(s.id) FROM Cobalt\Entity\Software s JOIN s.category c GROUP BY c.id';
        $query = $this->entityManager->createQuery($dql);
        return $query->getArrayResult();
    }
    
    public function summaryByManufacturer()
    {
        $dql = 'SELECT m.id, m.name, COUNT(s.id) FROM Cobalt\Entity\Software s JOIN s.manufacturer m GROUP BY m.id';
        $query = $this->entityManager->createQuery($dql);
        return $query->getArrayResult();
    }
    
}