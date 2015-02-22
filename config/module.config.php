<?php

return array(

    'view_manager' => array(
        'template_path_stack' => array(
            'admin' => __DIR__ . '/../view',
        ),
        'display_exceptions' => false,
        'display_not_found_reason' => false,
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),

    'router' => array(
        'routes' => array(
            'employees-list' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/employees',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Employees\Controller\User',
                        'controller'    => 'List',
                        'action'        => 'default',
                    ),
                ),
            ),
        ),
    ),

    'console' => array(
        'router' => array(
            'routes' => array(
                'employees-init' => array(
                    'options' => array(
                        'route'    => 'employees init',
                        'defaults' => array(
                            '__NAMESPACE__' => 'Employees\Controller\Console',
                            'controller' => 'Init',
                            'action'     => 'run'
                        )
                    )
                ),
            )
        )
    ),

);
