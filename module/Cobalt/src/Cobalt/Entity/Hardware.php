<?php

namespace Cobalt\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table="hardware"
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type_id", type="string")
 */
class Hardware
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */  
    protected $id;
    
    /** @ORM\Column(type="string") */
    protected $reference;
    
    /**
     * @ORM\ManyToOne(targetEntity="HardwareType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    protected $type;
    
    /**
     * @ORM\ManyToOne(targetEntity="HardwareStatus")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     */
    protected $status;
    
    /** @ORM\Column(type="string") */
    protected $model;
    
    /** @ORM\Column(type="string", name="serial_number")*/
    protected $serialNumber;
    
    /**
     * @ORM\ManyToOne(targetEntity="HardwareManufacturer")
     * @ORM\JoinColumn(name="manufacturer_id", referencedColumnName="id")
     */
    protected $manufacturer;
    
    /** @ORM\Column(type="date", name="purchase_date") */
    protected $purchaseDate;
    
    /** @ORM\Column(type="date", name="warranty_end_date") */
    protected $warrantyEndDate;
    
    /** @ORM\Column(type="date", name="disposal_date") */
    protected $disposalDate;
    
    /** @ORM\Column(type="string", name="asset_number") */
    protected $assetNumber;
    
    /** @ORM\Column(type="text") */
    protected $notes;
}