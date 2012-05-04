<?php
namespace Seafight\Controller;
use Zend\Mvc\Controller\ActionController,
    Zend\View\Model\ViewModel,
    Zend\File\Transfer\Adapter\Http,
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
            $formData = $request->post()->get('cells');
            $userName = $request->post()->get('username');
            $this->usersTable->addUser($userName);
//            $this->seafightTable->addShips($formData);
        }
    }    
    
    public function setUsersTable(UsersTable $usersTable)
    {
        $this->usersTable = $usersTable;
        return $this;
    }
}