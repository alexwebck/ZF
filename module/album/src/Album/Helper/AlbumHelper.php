<?php
namespace Album\Helper;
use Zend\View\Helper\AbstractHelper;
class AlbumHelper extends AbstractHelper {

    protected $albumHelper;
    
    public function getPhoto($nameFile) {

        if(!$nameFile) {
           $nameFile = 'no-image.gif';
        }
        return '/media/images/'.$nameFile;
    }
    
    public function setAlbumHelper(AlbumHelper $albumHelper) {
        $this->albumHelper = $albumHelper;
        return $this;
    }    
}