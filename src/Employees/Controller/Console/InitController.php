<?php

namespace Employees\Controller\Console;

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

        $vendorSiteConfigRootPath = dirname(dirname(dirname(dirname(__DIR__))));

        $this->fileSystem->symlink(
            $vendorSiteConfigRootPath . '/public/js/employees/',
            getcwd() . '/public/js/employees'
        );

        return "Success completed" . PHP_EOL;
    }
}
