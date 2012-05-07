<?php
return array(
    'di' => array(
        'instance' => array(
            'alias' => array(
                'Seafight' => 'Seafight\Controller\SeafightController',
            ),
            'Seafight\Controller\SeafightController' => array(
                'parameters' => array(
                    'usersTable' => 'Seafight\Model\UsersTable',
                    'gameTable' => 'Seafight\Model\GameTable',
                    'warTable' => 'Seafight\Model\WarTable',
                ),
            ),           
            'Seafight\Model\UsersTable' => array(
                'parameters' => array(
                    'adapter' => 'Zend\Db\Adapter\Adapter',
                    )
            ),
            'Seafight\Model\GameTable' => array(
                'parameters' => array(
                    'adapter' => 'Zend\Db\Adapter\Adapter',
                    )
            ),
            'Seafight\Model\WarTable' => array(
                'parameters' => array(
                    'adapter' => 'Zend\Db\Adapter\Adapter',
                    )
            ),            
            'Zend\View\Resolver\TemplatePathStack' => array(
                'parameters' => array(
                    'paths'  => array(
                        'Seafight' => __DIR__ . '/../view',
                    ),
                ),
            ),
        ),
    ),
);