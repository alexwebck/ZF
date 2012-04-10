<?php
namespace Album\Helper;
use Zend\View\Helper\AbstractHelper;
class AlbumHelper extends AbstractHelper {
    
    public function getPhoto($nameFile) {

        if(!$nameFile) {
           $nameFile = 'no-image.gif';
        }
        return '/media/images/'.$nameFile;
    }
}