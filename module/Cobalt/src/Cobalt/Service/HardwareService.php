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
}
