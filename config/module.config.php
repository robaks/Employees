<?php

return array(

    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'display_exceptions' => true,
        'display_not_found_reason' => true,
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
                        '__NAMESPACE__' => 'T4webEmployees\Controller\User',
                        'controller'    => 'List',
                        'action'        => 'default',
                    ),
                ),
            ),
            'employee-show' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/employee[/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'T4webEmployees\Controller\User',
                        'controller'    => 'Show',
                        'action'        => 'default',
                    ),
                ),
            ),
            'employee-add' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/employee/add',
                    'defaults' => array(
                        '__NAMESPACE__' => 'T4webEmployees\Controller\User',
                        'controller'    => 'Add',
                        'action'        => 'default',
                    ),
                ),
            ),
            'employee-edit' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/employee/edit[/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'T4webEmployees\Controller\User',
                        'controller'    => 'Edit',
                        'action'        => 'default',
                    ),
                ),
            ),
            'employee-create' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/employee/create',
                    'defaults' => array(
                        '__NAMESPACE__' => 'T4webEmployees\Controller\User',
                        'controller'    => 'CreateAjax',
                        'action'        => 'default',
                    ),
                ),
            ),
            'employee-save' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/employee/save',
                    'defaults' => array(
                        '__NAMESPACE__' => 'T4webEmployees\Controller\User',
                        'controller'    => 'SaveAjax',
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
                            '__NAMESPACE__' => 'T4webEmployees\Controller\Console',
                            'controller' => 'Init',
                            'action'     => 'run'
                        )
                    )
                ),
            )
        )
    ),

    'db' => array(
        'tables' => array(
            't4webemployees-employee' => array(
                'name' => 'employees',
                'columnsAsAttributesMap' => array(
                    'id' => 'id',
                    'name' => 'name',
                    'surname' => 'surname',
                    'patronymic' => 'patronymic',
                    'avatar' => 'avatar',
                ),
            ),
            't4webemployees-personalinfo' => array(
                'name' => 'employees_personal_info',
                'columnsAsAttributesMap' => array(
                    'employee_id' => 'employeeId',
                    'birthday' => 'birthday',
                    'phone' => 'phone',
                    'passport' => 'passport',
                    'ipn' => 'ipn',
                    'address' => 'address',
                    'registration_address' => 'registrationAddress',
                    'contacts' => 'contacts',
                ),
            ),
            't4webemployees-workinfo' => array(
                'name' => 'employees_work_info',
                'columnsAsAttributesMap' => array(
                    'employee_id' => 'employeeId',
                    'job_title' => 'jobTitleId',
                    'status' => 'statusId',
                    'start_work_date' => 'startWorkDate',
                    'end_work_date' => 'endWorkDate',
                ),
            ),
            't4webemployees-social' => array(
                'name' => 'employees_social',
                'columnsAsAttributesMap' => array(
                    'employee_id' => 'employeeId',
                    'skype' => 'skype',
                    'personal_email' => 'personalEmail',
                    'email' => 'email',
                    'facebook' => 'facebook',
                    'vk' => 'vk',
                    'linkedin' => 'linkedin',
                ),
            ),
        ),
        'dependencies' => array(
            'WorkInfo' => array(
                'Employees' => array(
                    array(
                        'table' => 'employees_work_info',
                        'rule' => 'employees_work_info.employee_id = employees.id',
                    ),
                ),
            ),
            'PersonalInfo' => array(
                'Employees' => array(
                    array(
                        'table' => 'employees_personal_info',
                        'rule' => 'employees_personal_info.employee_id = employees.id',
                    ),
                ),
            ),
        ),
    ),
    'criteries' => array(
        'Employee' => array(
            'empty' => array(
                'table' => 'employees'
            ),
        )
    ),
);
