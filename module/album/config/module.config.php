<?php
return array(
    'di' => array(
        'instance' => array(
            'alias' => array(
                'album' => 'Album\Controller\AlbumController',
            ),
            'Album\Controller\AlbumController' => array(
                'parameters' => array(
                    'albumTable' => 'Album\Model\AlbumTable',
                ),
            ),
            'Album\Helper\AlbumHelper' => array(
                'parameters' => array(
                    'albumHelper' => 'Album\Helper\AlbumHelper',
                ),
            ),            
            'Album\Model\AlbumTable' => array(
                'parameters' => array(
                    'adapter' => 'Zend\Db\Adapter\Adapter',
                    )
            ),
            'Zend\View\Resolver\TemplatePathStack' => array(
                'parameters' => array(
                    'paths'  => array(
                        'album' => __DIR__ . '/../view',
                    ),
                ),
            ),
        ),
    ),
);