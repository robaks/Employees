<?php

namespace T4webEmployees\Employee;

use T4webBase\Domain\Status;

class JobTitle extends Status {
    
    const JUNIOR_SOFTWARE_DEVELOPER = 1;
    const MIDDLE_SOFTWARE_DEVELOPER = 2;
    const SENIOR_SOFTWARE_DEVELOPER = 3;
    const LEAD_SOFTWARE_DEVELOPER = 4;
    const JUNIOR_QA_ENGINEER = 5;
    const MIDDLE_QA_ENGINEER = 6;
    const SENIOR_QA_ENGINEER = 7;
    const LEAD_QA_ENGINEER = 8;
    const PROJECT_MANAGER = 9;
    const FRONTEND_ENGINEER = 10;
    const DESIGNER = 11;
    const CEO = 12;
    const CTO = 13;

    /**
     * @var array
     */
    protected static $constants = array(
        self::JUNIOR_SOFTWARE_DEVELOPER => 'Junior Software developer',
        self::MIDDLE_SOFTWARE_DEVELOPER => 'Middle Software developer',
        self::SENIOR_SOFTWARE_DEVELOPER => 'Senior Software developer',
        self::LEAD_SOFTWARE_DEVELOPER => 'Lead Software developer',
        self::JUNIOR_QA_ENGINEER => 'Junior QA engineer',
        self::MIDDLE_QA_ENGINEER => 'Middle QA engineer',
        self::SENIOR_QA_ENGINEER => 'Senior QA engineer',
        self::LEAD_QA_ENGINEER => 'Lead QA engineer',
        self::PROJECT_MANAGER => 'Project Manager',
        self::FRONTEND_ENGINEER => 'Frontend engineer',
        self::DESIGNER => 'Designer',
        self::CEO => 'Chief Executive Officer',
        self::CTO => 'Chief technology officer',
    );

}