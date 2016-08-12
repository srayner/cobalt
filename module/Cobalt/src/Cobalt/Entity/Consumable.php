<?php

namespace Cobalt\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/** @ORM\Entity
  * @ORM\Table(name="consumable")
  */
class Consumable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */  
    protected $id;
    
    /** @ORM\Column(type="string") */
    protected $name;
    
    /** @ORM\Column(type="text", name="description") */
    protected $description;
    
    /** @ORM\Column(type="string", name="type") */
    protected $type;
   
    /** @ORM\Column(type="string", name="supplier") */
    protected $supplier;
   
    /** @ORM\Column(type="integer", name="qty_in_stock") */
    protected $qtyInStock;
    
    /** @ORM\Column(type="integer", name="reorder_qty") */
    protected $reorderQty;
    
    /**
     * @ORM\ManyToMany(targetEntity="Printer", mappedBy="consumables")
     */
    protected $printers;
    
    public function __construct()
    {
        $this->printers = new ArrayCollection();
    }
    
    public function addPrinter($printer)
    {
        $this->printers[] = $printer;
        return $this;
    }
    
    public function removePrinter($printer)
    {
        $this->printers->removeElement($printer);
        return $this;
    }
    
    public function getPrinters()
    {
        return $this->printers->toArray();
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getSupplier()
    {
        return $this->supplier;
    }

    public function getQtyInStock()
    {
        return $this->qtyInStock;
    }

    public function getReorderQty()
    {
        return $this->reorderQty;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function setSupplier($supplier)
    {
        $this->supplier = $supplier;
        return $this;
    }

    public function setQtyInStock($qtyInStock)
    {
        $this->qtyInStock = $qtyInStock;
        return $this;
    }

    public function setReorderQty($reorderQty)
    {
        $this->reorderQty = $reorderQty;
        return $this;
    }


}