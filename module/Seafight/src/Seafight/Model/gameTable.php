<?php
namespace Seafight\Model;
use Zend\Db\TableGateway\TableGateway,
    Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet;
class GameTable extends TableGateway
{
    public function __construct(Adapter $adapter = null, $databaseSchema = null, 
        ResultSet $selectResultPrototype = null)
    {
        return parent::__construct('game', $adapter, $databaseSchema, 
            $selectResultPrototype);
    }
    
    public function addGame($user_id, $user_type = 1, $status = 1)
    {
        $data = array(
            'id_user'.$user_type => $user_id,
            'status' => $status,
        );
        
        $db = $this->getAdapter()->getDriver()->getConnection();
        $db->beginTransaction();
        
        try {
            $this->insert($data);
            $db->commit();
            return $this->lastInsertId;;
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
    
}

?>
