<?php
// This is global bootstrap for autoloading
if (file_exists('../../../vendor/autoload.php')) {
    include '../../../vendor/autoload.php';
} else {
    include './vendor/autoload.php';
}

define('TESTS_FOLDER_PATH', __DIR__);