<?php

namespace Cobalt\Model\Computer;

use ZfcBase\Mapper\AbstractDbMapper;
use Cobalt\Service\DbAdapterAwareInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Sql\Sql;

class ComputerMapper extends AbstractDbMapper implements ComputerMapperInterface, DbAdapterAwareInterface
{
    protected $tableName = 'computer';
    
    public function getComputers()
    {
        $select = $this->getSelect();
        return $this->select($select);
    }
    
    public function getComputerById($computerId)
    {
        $select = $this->getSelect()
                       ->where(array('computer_id' => $computerId));
        return $this->select($select)->current();
    }
    
    public function getComputerByHostname($hostname)
    {
        $select = $this->getSelect()
                       ->where(array('hostname' => $hostname));
        return $this->select($select)->current();
    }
    
    public function getComputerBySerialNumber($serialNumber)
    {
        $select = $this->getSelect()
                       ->where(array('serial_number' => $serialNumber));
        return $this->select($select)->current();
    }
    
    public function count($search = null)
    {
        $adapter = $this->getDbAdapter();
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->columns(array('cnt' => new \Zend\Db\Sql\Expression('COUNT(*)')))
                ->from($this->tableName);
        if ($search){
            $select->where("hostname like '%$search%'");
        }
        $selectString = $sql->buildSqlString($select);
        return (int)$adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE)->current()['cnt'];
    }
    
    public function persist(ComputerInterface $computer)
    {
        if ($computer->getComputerId() > 0) {
            $this->update($computer, null, null, new ComputerHydrator);
        } else {
            $this->insert($computer, null, new ComputerHydrator);
        }
        return $computer;        
    }
    
    protected function insert($entity, $tableName = null, HydratorInterface $hydrator = null)
    {
        die(var_dump($entity));
        $result = parent::insert($entity, $tableName, $hydrator);
        $entity->setComputerId($result->getGeneratedValue());
        return $result;
    }
    
    protected function update($entity, $where = null, $tableName = null, HydratorInterface $hydrator = null)
    {
        if (!$where) {
            $where = 'computer_id = ' . $entity->getComputerId();
        }
        $entity->setModified(new \DateTime());
        return parent::update($entity, $where, $tableName, $hydrator);
    }
}

