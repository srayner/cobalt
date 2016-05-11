<?php

namespace Cobalt\Service;

class PrinterService extends AbstractEntityService
{
    public function setType($printer, $typeName)
    {
        $type = $this->entityManager->getRepository('Cobalt\Entity\HardwareType')->findOneBy(array(
            'name' => $typeName
        ));
        $printer->setType($type);
    }
    
}
