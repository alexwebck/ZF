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
            
            $user = $this->usersTable->getUser(array('name' => $userName));
            if(!$user) {
                $user_id = $this->usersTable->addUser($userName);
            } else {
                $user_id = $user->id;
            }
            $game_id = $this->gameTable->addGame($user_id);
            $this->warTable->addWar($game_id, '', serialize($ships_location));
            
            $userName = $request->post()->get('username');
            return;            
        }
    }  
    
    public function waitingAction() 
    {
        $request = $this->getRequest();
        if($request->isPost()) {
            $formData = $request->post()->toArray();
            $game_id = str_replace('game_id', '', $formData['game_id']); 
            $user2 = $formData['username'];
            $user = $this->usersTable->getUser(array('name' => $user2));

            if(!$user) {
                $user_id = $this->usersTable->addUser($user2);
            } else {
                $user_id = $user->id;
            }
            $this->gameTable->addGame($user_id, 2, 2);
            return $this->redirect()->toRoute('default', array(
                'controller' => 'seafight',
                'action'     => 'game',
            ));
        } else {
            $game = $this->gameTable->getGame(1);
            return array('game' => $game);
        }
    }
    
    public function gameAction() 
    {
        
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