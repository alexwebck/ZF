<?php
namespace Seafight\Model;
use Zend\Db\TableGateway\TableGateway,
    Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet;
class SeafightTable extends TableGateway
{
    public function __construct(Adapter $adapter = null, $databaseSchema = null, 
        ResultSet $selectResultPrototype = null)
    {
        return parent::__construct('war', $adapter, $databaseSchema, 
            $selectResultPrototype);
    }
    public function fetchAll()
    {
        $resultSet = $this->select();
        return $resultSet;
    }
    public function getAlbum($id)
    {
        $id  = (int) $id;
        $rowset = $this->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {            throw new \Exception("Could not find row $id");
        }
        return $row;
    }    

    public function addShips($seafight)
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
        } catch (Exception $e) {
            $db->rollBack();
            echo $e->getMessage();
        }
    }
    public function updateAlbum($id, $artist, $title, $photo)
    {
        $data = array(
            'artist' => $artist,
            'title'  => $title,
            'photo' => $photo,
        );
        $this->update($data, array('id' => $id));
    }
    public function deleteAlbum($id)
    {
        $this->delete(array('id' => $id));
    }
}