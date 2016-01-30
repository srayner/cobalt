<?php

namespace Cobalt\Service;

interface ComputerServiceInterface
{
    public function __construct($entityManager, $repository);
    public function count();
    public function findAll();
    public function findById($id);
    public function findBySerial($serial);
    public function persist($computer);
    public function remove($computer);
}
