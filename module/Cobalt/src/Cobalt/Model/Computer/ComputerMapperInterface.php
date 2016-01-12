<?php

namespace Cobalt\Model\Computer;

interface ComputerMapperInterface
{
    public function getComputers();
    public function getComputerById($computerId);
    public function getComputerByHostname($hostname);
    public function getComputerBySerialNumber($serialNo);
    public function persist(ComputerInterface $computer);
    public function count($search = null);
}