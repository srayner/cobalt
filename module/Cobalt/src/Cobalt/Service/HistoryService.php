<?php

namespace Cobalt\Service;

class HistoryService
{
    private $entityManager;
    private $repository;
    
    public function __construct($entityManager, $repository)
    {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
    }
    
    public function find($tableId, $rowId)
    {
        return $this->entityManager->getRepository($this->repository)->findBy(array(
            'tableId' => $tableId,
            'rowId'   => $rowId
        ));
    }   
}
