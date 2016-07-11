<?php

namespace Cobalt\Entity;

use Doctrine\ORM\Mapping as ORM;

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
    
    /** @ORM\Column(type="string", name="consumable_name") */
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