<?php
namespace Album\Form;
use Zend\Form\Form,
    Album\Helper\AlbumHelper,
    Zend\Form\Element;
class AlbumForm extends Form
{
    public function init()
    {
        $this->setName('album');
        $path = AlbumHelper::basePath();
        $id = new Element\Hidden('id');
        $id->addFilter('Int');
        
        $artist = new Element\Text('artist');
        $artist->setLabel('Artist')
               ->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty');
        $photo = new Element\File('photo');
        $photo->setLabel('Photo')
              ->setRequired(true)
              ->setDestination($path . DIRECTORY_SEPARATOR . 'media' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR)
              ->addValidator('Size', false, 1024000)
              ->addValidator('Extension', false, 'jpg,png,gif');                
 
        $title = new Element\Text('title');
        $title->setLabel('Title')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        
        $submit = new Element\Submit('submit');
        $submit->setAttrib('id', 'submitbutton');
        
        $this->addElements(array($id, $artist, $title, $photo, $submit));
    }
}