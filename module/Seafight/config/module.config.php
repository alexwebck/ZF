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
                ),
            ),           
            'Seafight\Model\UsersTable' => array(
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