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
        $table->addColumn(new Column\Integer('id'));
        $table->addColumn(new Column\Varchar('name', 50));
        $table->addColumn(new Column\Varchar('surname', 50));
        $table->addColumn(new Column\Varchar('patronymic', 50));
        $table->addColumn(new Column\Varchar('avatar', 50));
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
