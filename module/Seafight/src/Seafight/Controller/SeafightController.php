<?php
namespace Seafight\Controller;
use Zend\Mvc\Controller\ActionController,
    Zend\View\Model\ViewModel,
    Zend\File\Transfer\Adapter\Http,
    Seafight\Model\GameTable,
    Seafight\Model\WarTable,
    Seafight\Model\UsersTable;
class SeafightController extends ActionController
{
    
    public function indexAction()
    {
        return new ViewModel();
    }
    
    public function addAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $ships_location = $request->post()->get('cells');
            $userName = $request->post()->get('username');
            
            $user_id = $this->usersTable->addUser($userName);
            $game_id = $this->gameTable->addGame($user_id);
            $this->warTable->addWar($game_id, '', serialize($ships_location));
            
            $userName = $request->post()->get('username');
            return;            
        }
    }    
    
    public function setUsersTable(UsersTable $usersTable)
    {
        $this->usersTable = $usersTable;
        return $this;
    }
    public function setGameTable(GameTable $gameTable)
    {
        $this->gameTable = $gameTable;
        return $this;
    }
    public function setWarTable(WarTable $warTable)
    {
        $this->warTable = $warTable;
        return $this;
    }    
}