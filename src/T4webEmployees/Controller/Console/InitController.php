<?php

namespace T4webEmployees\Controller\Console;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Ddl;
use Zend\Db\Sql\Ddl\Column;
use Zend\Db\Sql\Ddl\Constraint;
use Zend\Db\Sql\Sql;
use PDOException;
use League\Flysystem\Filesystem;

class InitController extends AbstractActionController {

    /**
     * @var Adapter
     */
    private $dbAdapter;

    /**
     * @var Filesystem
     */
    private $fileSystem;

    public function __construct(Adapter $dbAdapter, Filesystem $fileSystem){
        $this->dbAdapter = $dbAdapter;
        $this->fileSystem = $fileSystem;
    }

    public function runAction() {

        $this->createTableEmployees();
        $this->createTableEmployeesPersonalInfo();
        $this->createTableEmployeesWorkInfo();
        $this->createTableEmployeesSocial();
        $this->createTableSalary();

        $vendorSiteConfigRootPath = dirname(dirname(dirname(dirname(__DIR__))));

        if (!$this->fileSystem->has('/public/js/t4web-employees/add.js')) {
            $this->fileSystem->symlink(
                $vendorSiteConfigRootPath . '/public/js/t4web-employees/',
                getcwd() . '/public/js/t4web-employees'
            );
        }

        return "Success completed" . PHP_EOL;
    }

    private function createTableEmployees() {
        $table = new Ddl\CreateTable('employees');

        $id = new Column\Integer('id');
        $id->setOption('AUTO_INCREMENT', 1);
        $table->addColumn($id);
        $table->addColumn(new Column\Varchar('name', 50));
        $table->addColumn(new Column\Varchar('surname', 50));

        $patronymic = new Column\Varchar('patronymic', 50);
        $patronymic->setNullable(true);
        $table->addColumn($patronymic);

        $avatar = new Column\Varchar('avatar', 50);
        $avatar->setNullable(true);
        $table->addColumn($avatar);

        $table->addConstraint(new Constraint\PrimaryKey('id'));

        $sql = new Sql($this->dbAdapter);

        try {
            $this->dbAdapter->query(
                $sql->getSqlStringForSqlObject($table),
                Adapter::QUERY_MODE_EXECUTE
            );
        } catch (PDOException $e) {
            return $e->getMessage() . PHP_EOL;
        }
    }

    private function createTableEmployeesPersonalInfo() {
        $table = new Ddl\CreateTable('employees_personal_info');

        $table->addColumn(new Column\Integer('employee_id'));

        $birthday = new Column\Date('birthday');
        $birthday->setNullable(true);
        $table->addColumn($birthday);

        $phone = new Column\Varchar('phone', 14);
        $phone->setNullable(true);
        $table->addColumn($phone);

        $passport = new Column\Varchar('passport', 255);
        $passport->setNullable(true);
        $table->addColumn($passport);

        $ipn = new Column\Varchar('ipn', 10);
        $ipn->setNullable(true);
        $table->addColumn($ipn);

        $address = new Column\Varchar('address', 255);
        $address->setNullable(true);
        $table->addColumn($address);

        $registrationAddress = new Column\Varchar('registration_address', 255);
        $registrationAddress->setNullable(true);
        $table->addColumn($registrationAddress);

        $contacts = new Column\Varchar('contacts', 255);
        $contacts->setNullable(true);
        $table->addColumn($contacts);

        $table->addConstraint(new Constraint\PrimaryKey('employee_id'));

        $sql = new Sql($this->dbAdapter);

        try {
            $this->dbAdapter->query(
                $sql->getSqlStringForSqlObject($table),
                Adapter::QUERY_MODE_EXECUTE
            );
        } catch (PDOException $e) {
            return $e->getMessage() . PHP_EOL;
        }
    }

    private function createTableEmployeesWorkInfo() {
        $table = new Ddl\CreateTable('employees_work_info');

        $table->addColumn(new Column\Integer('employee_id'));
        $table->addColumn(new Column\Integer('job_title'));
        $table->addColumn(new Column\Integer('status'));
        $table->addColumn(new Column\Date('start_work_date'));
        $table->addColumn(new Column\Date('end_work_date'));
        $table->addColumn(new Column\Text('comment'));
        $table->addConstraint(new Constraint\PrimaryKey('employee_id'));

        $sql = new Sql($this->dbAdapter);

        try {
            $this->dbAdapter->query(
                $sql->getSqlStringForSqlObject($table),
                Adapter::QUERY_MODE_EXECUTE
            );
        } catch (PDOException $e) {
            return $e->getMessage() . PHP_EOL;
        }
    }

    private function createTableEmployeesSocial() {
        $table = new Ddl\CreateTable('employees_social');

        $table->addColumn(new Column\Integer('employee_id'));

        $skype = new Column\Varchar('skype', 50);
        $skype->setNullable(true);
        $table->addColumn($skype);

        $personalEmail = new Column\Varchar('personal_email', 50);
        $personalEmail->setNullable(true);
        $table->addColumn($personalEmail);

        $email = new Column\Varchar('email', 50);
        $email->setNullable(true);
        $table->addColumn($email);

        $facebook = new Column\Varchar('facebook', 100);
        $facebook->setNullable(true);
        $table->addColumn($facebook);

        $vk = new Column\Varchar('vk', 100);
        $vk->setNullable(true);
        $table->addColumn($vk);

        $linkedin = new Column\Varchar('linkedin', 100);
        $linkedin->setNullable(true);
        $table->addColumn($linkedin);

        $table->addConstraint(new Constraint\PrimaryKey('employee_id'));

        $sql = new Sql($this->dbAdapter);

        try {
            $this->dbAdapter->query(
                $sql->getSqlStringForSqlObject($table),
                Adapter::QUERY_MODE_EXECUTE
            );
        } catch (PDOException $e) {
            return $e->getMessage() . PHP_EOL;
        }
    }

    private function createTableSalary() {
        $table = new Ddl\CreateTable('salary');

        $table->addColumn(new Column\Integer('id'));
        $table->addColumn(new Column\Integer('employee_id'));
        $table->addColumn(new Column\Integer('amount'));
        $table->addColumn(new Column\Integer('currency'));

        $date = new Column\Date('date');
        $table->addColumn($date);

        $table->addConstraint(new Constraint\PrimaryKey('id'));

        $sql = new Sql($this->dbAdapter);

        try {
            $this->dbAdapter->query(
                $sql->getSqlStringForSqlObject($table),
                Adapter::QUERY_MODE_EXECUTE
            );
        } catch (PDOException $e) {
            return $e->getMessage() . PHP_EOL;
        }
    }
}
