<?php
namespace Seafight\Model;
use Zend\Db\TableGateway\TableGateway,
    Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet;
class WarTable extends TableGateway
{
    public function __construct(Adapter $adapter = null, $databaseSchema = null, 
        ResultSet $selectResultPrototype = null)
    {
        return parent::__construct('war', $adapter, $databaseSchema, 
            $selectResultPrototype);
    }
    
    public function addWar($gasme_id, $hit_shot = '', $ships_location = '')
    {
        $war = '';
        $data = array(
            'id_game' => $gasme_id,
            'hit_shot' => $hit_shot,
        );
        if($ships_location) $data['ships_location'] = $ships_location;
        
        $db = $this->getAdapter()->getDriver()->getConnection();
        $db->beginTransaction();
        
        try {
            $war = $this->insert($data);
            $db->commit();
            return $war;
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
