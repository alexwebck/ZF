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
        return parent::__construct('seafight', $adapter, $databaseSchema, 
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

        $this->insert($data);
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