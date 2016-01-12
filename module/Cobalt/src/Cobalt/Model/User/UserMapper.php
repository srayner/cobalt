<?php

namespace Cobalt\Model\User;

use ZfcBase\Mapper\AbstractDbMapper;
use Cobalt\Service\DbAdapterAwareInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Sql\Sql;

class UserMapper extends AbstractDbMapper implements UserMapperInterface, DbAdapterAwareInterface
{
    protected $tableName = 'user';
    
    public function getUsers()
    {
        $select = $this->getSelect();
        return $this->select($select);
    }
    
    public function getUserById($userId)
    {
        $select = $this->getSelect()
                       ->where(array('user_id' => $userId));
        return $this->select($select)->current();
    }
    
    public function getUserBySamAccountName($samAccountName)
    {
        $select = $this->getSelect()
                       ->where(array('sam_account_name' => $samAccountName));
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
            $select->where("sam_account_name like '%$search%'");
        }
        $selectString = $sql->buildSqlString($select);
        return (int)$adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE)->current()['cnt'];
    }
    
    public function persist(UserInterface $user)
    {
        if ($user->getUserId() > 0) {
            $this->update($user, null, null, new UserHydrator);
        } else {
            $this->insert($user, null, new UserHydrator);
        }
        return $user;        
    }
    
    protected function insert($entity, $tableName = null, HydratorInterface $hydrator = null)
    {
        $result = parent::insert($entity, $tableName, $hydrator);
        $entity->setUserId($result->getGeneratedValue());
        return $result;
    }
    
    protected function update($entity, $where = null, $tableName = null, HydratorInterface $hydrator = null)
    {
        if (!$where) {
            $where = 'user_id = ' . $entity->getUserId();
        }
//        $entity->setModified(new \DateTime());
        return parent::update($entity, $where, $tableName, $hydrator);
    }
}