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
    
    public function getGame($status)
    {
        $status  = (int) $status;
        $query = "
            SELECT * FROM game AS g
            INNER JOIN users AS u 
            ON g.id_user1 = u.id
            WHERE g.status = '$status'
            ORDER BY g.id DESC
            ";
        $adapter = $this->getAdapter();
        $rowset = $adapter->query($query, Adapter::QUERY_MODE_EXECUTE);
        return $rowset;
    }
    
}

?>
