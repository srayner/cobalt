<?php

namespace Cobalt\Model\LogicalDisk;

interface LogicalDiskMapperInterface
{
    public function getLogicalDisks($computerId);
    public function deleteLogicalDisks($computerId);
    public function persist(LogicalDiskInterface $logicalDisk);
}