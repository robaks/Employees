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

    'controller_action_injections' => array(
        'T4webEmployees\Controller\User\SaveAjaxController' => array(
            'defaultAction' => array(
                'request',
                'T4webEmployees\ViewModel\SaveAjaxViewModel',
                'T4webEmployees\Employee\Service\Update',
                'fileSystem',
            ),
        ),
    ),

    'controllers' => array(
        'invokables' => array(
            'T4webEmployees\Controller\User\SaveAjax' => 'T4webEmployees\Controller\User\SaveAjaxController',
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
            'employee-salary-currencies' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/employee/salary-ajax/currencies',
                    'defaults' => array(
                        '__NAMESPACE__' => 'T4webEmployees\Controller\User',
                        'controller'    => 'SalaryAjax',
                        'action'        => 'get-currencies',
                    ),
                ),
            ),
            'employee-salary-save' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/employee[/:employeeId]/salary-ajax/save',
                    'defaults' => array(
                        '__NAMESPACE__' => 'T4webEmployees\Controller\User',
                        'controller'    => 'SalaryAjax',
                        'action'        => 'save',
                    ),
                ),
            ),
            'employee-salary-delete' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/employee/salary-ajax/delete',
                    'defaults' => array(
                        '__NAMESPACE__' => 'T4webEmployees\Controller\User',
                        'controller'    => 'SalaryAjax',
                        'action'        => 'delete',
                    ),
                ),
            ),
            'employees-salary-list' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/employees/salary-list[/:year]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'T4webEmployees\Controller\User',
                        'controller'    => 'SalaryList',
                        'action'        => 'sheet',
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

    'view_helpers' => array(
        'invokables' => array(
            'employeesYearPaginator' => 'T4webEmployees\View\Helper\EmployeesYearPaginator',
        ),
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
                'pk' => 'employee_id',
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
                'pk' => 'employee_id',
                'columnsAsAttributesMap' => array(
                    'employee_id' => 'employeeId',
                    'job_title' => 'jobTitleId',
                    'status' => 'statusId',
                    'start_work_date' => 'startWorkDate',
                    'end_work_date' => 'endWorkDate',
                    'comment' => 'comment',
                ),
            ),
            't4webemployees-social' => array(
                'name' => 'employees_social',
                'pk' => 'employee_id',
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
            't4webemployees-salary' => array(
                'name' => 'salary',
                'pk' => 'id',
                'columnsAsAttributesMap' => array(
                    'id' => 'id',
                    'employee_id' => 'employeeId',
                    'amount' => 'amount',
                    'currency' => 'currency',
                    'date' => 'date',
                    'comment' => 'comment',
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
            'empty' => array('table' => 'employees'),
        ),
        'PersonalInfo' => array(
            'empty' => array('table' => 'employees_personal_info'),
        ),
        'Social' => array(
            'empty' => array('table' => 'employees_social'),
        ),
        'WorkInfo' => array(
            'empty' => array('table' => 'employees_work_info'),
            'status' => array(
                'table' => 'employees_work_info',
                'field' => 'status',
                'buildMethod' => 'addFilterEqual',
            ),
            'startWorkDateLess' => array(
                'table' => 'employees_work_info',
                'field' => 'start_work_date',
                'buildMethod' => 'addFilterLess',
            ),
            'limit' => array(
                'table' => 'employees_work_info',
                'field' => '',
                'buildMethod' => 'limit',
            ),
            'page' => array(
                'table' => 'employees_work_info',
                'field' => '',
                'buildMethod' => 'page',
            ),
        ),
        'Salary' => array(
            'empty' => array('table' => 'salary'),
            'Id' => array(
                'table' => 'salary',
                'field' => 'id',
                'buildMethod' => 'addFilterEqual',
            ),
            'employeeId' => array(
                'table' => 'salary',
                'field' => 'employee_id',
                'buildMethod' => 'addFilterEqual',
            ),
        ),
    ),
);
