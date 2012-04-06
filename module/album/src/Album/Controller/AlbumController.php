<?php
namespace Album\Controller;
use Zend\Mvc\Controller\ActionController,
    Zend\View\Model\ViewModel,
    Album\Model\AlbumTable,
    Zend\File\Transfer\Adapter\Http,
    Album\Form\AlbumForm;
class AlbumController extends ActionController
{
    protected $albumTable;
    
    public function indexAction()
    {
        return new ViewModel(array(
            'albums' => $this->albumTable->fetchAll(),
        ));
    }
    public function addAction()
    {
        $form = new AlbumForm();
        $form->submit->setLabel('Add');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $formData = $request->post()->toArray();
            if ($form->isValid($formData)) {
                $artist = $form->getValue('artist');
                $title  = $form->getValue('title');
                $photo  = $form->getValue('photo');            
                
                $this->albumTable->addAlbum($artist, $title, $photo);
                // Redirect to list of albums
                return $this->redirect()->toRoute('default', array(
                    'controller' => 'album',
                    'action'     => 'index',
                ));
            }
        }
        return array('form' => $form);
    }
    public function editAction()
    {
        $form = new AlbumForm();
        $form->submit->setLabel('Edit');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $formData = $request->post()->toArray();
            if ($form->isValid($formData)) {
                $id     = $form->getValue('id');
                $artist = $form->getValue('artist');
                $title  = $form->getValue('title');
                $photo  = $form->getValue('photo');                
                
                $res = new Http();
                $res->receive($photo);
                if ($this->albumTable->getAlbum($id)) {
                    $this->albumTable->updateAlbum($id, $artist, $title, $photo);
                }
                // Redirect to list of albums
                return $this->redirect()->toRoute('default', array(
                    'controller' => 'album',
                    'action'     => 'index',
                ));
            }
        } else {
            $id = $request->query()->get('id', 0);
            if ($id > 0) {
                $album = $this->albumTable->getAlbum($id);
                $form->populate($album->getArrayCopy());
            }
        }
        return array('form' => $form);
    }
    public function deleteAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->post()->get('del', 'No');
            if ($del == 'Yes') {
                $id = $request->post()->get('id');
                $this->albumTable->deleteAlbum($id);            }
            // Redirect to list of albums
            return $this->redirect()->toRoute('default', array(
                'controller' => 'album',
                'action'     => 'index',
            ));
        }
        $id = $request->query()->get('id', 0);
        return array('album' => $this->albumTable->getAlbum($id));
    }
    public function setAlbumTable(AlbumTable $albumTable)
    {
        $this->albumTable = $albumTable;
        return $this;
    }
}