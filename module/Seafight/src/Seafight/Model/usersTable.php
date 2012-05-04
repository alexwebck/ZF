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
        $this->insert($data);
    }
}

?>
