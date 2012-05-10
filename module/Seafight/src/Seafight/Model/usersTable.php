<?php
namespace Seafight\Model;
use Zend\Db\TableGateway\TableGateway,
    Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet;
class UsersTable extends TableGateway
{
    public function __construct(Adapter $adapter = null, $databaseSchema = null, 
        ResultSet $selectResultPrototype = null)
    {
        return parent::__construct('users', $adapter, $databaseSchema, 
            $selectResultPrototype);
    }
    
    public function addUser($username)
    {
        $data = array(
            'user' => md5($username),
            'name' => $username,
        );
        
        $db = $this->getAdapter()->getDriver()->getConnection();
        $db->beginTransaction();
        
        try {
            $this->insert($data);
            $db->commit();
            return $this->lastInsertId;
        } catch (Exception $e) {
            $db->rollBack();
            echo $e->getMessage();
        }
    }
    
     public function fetchAll()
    {
        $resultSet = $this->select();
        return $resultSet;
    }
    
    public function getUser($array)
    {
        $rowset = $this->select($array);
        $row = $rowset->current();
        return $row;
    }    
}

?>
