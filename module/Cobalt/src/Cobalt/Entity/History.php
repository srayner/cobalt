<?php

namespace Cobalt\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity
  * @ORM\Table(name="history")
  */
class History
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    
    /** @ORM\Column(type="integer", name="table_id") */
    protected $tableId;
    
    /** @ORM\Column(type="integer", name="row_id") */
    protected $rowId;
    
    /** @ORM\Column(type="datetime", name="date_time") */
    protected $time;
    
    /** @ORM\Column(type="string", name="what") */
    protected $event;
    
    public function getId()
    {
        return $this->id;
    }

    public function getTableId()
    {
        return $this->tableId;
    }

    public function getRowId()
    {
        return $this->rowId;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function getEvent()
    {
        return $this->event;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setTableId($tableId)
    {
        $this->tableId = $tableId;
        return $this;
    }

    public function setRowId($rowId)
    {
        $this->rowId = $rowId;
        return $this;
    }

    public function setTime($time)
    {
        $this->time = $time;
        return $this;
    }

    public function setEvent($event)
    {
        $this->event = $event;
        return $this;
    }


}

