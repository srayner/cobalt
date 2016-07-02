<?php

namespace Cobalt\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table="hardware"
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="classname", type="string")
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
    
    /**
     * @ORM\OneToMany(targetEntity="NetworkAdapter", mappedBy="hardware")
     *
     * @var ArrayCollection 
     */
    protected $networkAdapters;
    
    public function __construct()
    {
        $this->networkAdapters = new ArrayCollection();
    }
    
    /**
     * Adds a network adapter to the hardware.
     * 
     * @param NetworkAdapter $networkAdapter
     * @return Hardware
     */
    public function addNetworkAdapter(NetworkAdapter $networkAdapter)
    {
        $this->networkAdapters[] = $networkAdapter;
        $networkAdapter->setHardware($this);
        return $this;
    }
    
    /**
     * Returns an array containing the network adaptors.
     * 
     * @return Array
     */
    public function getNetworkAdapters()
    {
        return $this->networkAdapters->toArray();
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getReference()
    {
        return $this->reference;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getSerialNumber()
    {
        return $this->serialNumber;
    }

    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    public function getPurchaseDate()
    {
        return $this->purchaseDate;
    }

    public function getWarrantyEndDate()
    {
        return $this->warrantyEndDate;
    }

    public function getDisposalDate()
    {
        return $this->disposalDate;
    }

    public function getAssetNumber()
    {
        return $this->assetNumber;
    }

    public function getNotes()
    {
        return $this->notes;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    public function setSerialNumber($serialNumber)
    {
        $this->serialNumber = $serialNumber;
        return $this;
    }

    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;
        return $this;
    }

    public function setPurchaseDate($purchaseDate)
    {
        $this->purchaseDate = $purchaseDate;
        return $this;
    }

    public function setWarrantyEndDate($warrantyEndDate)
    {
        $this->warrantyEndDate = $warrantyEndDate;
        return $this;
    }

    public function setDisposalDate($disposalDate)
    {
        $this->disposalDate = $disposalDate;
        return $this;
    }

    public function setAssetNumber($assetNumber)
    {
        $this->assetNumber = $assetNumber;
        return $this;
    }

    public function setNotes($notes)
    {
        $this->notes = $notes;
        return $this;
    }


}