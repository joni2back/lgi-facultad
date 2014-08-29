<?php
error_reporting(E_ALL);

require_once dirname(__FILE__) . '/constants.php';
require_once dirname(__FILE__) . '/application.php';
require_once dirname(__FILE__) . '/mysqldb.php';
require_once dirname(__FILE__) . '/inputdata.php';

$app = new Application(
    new MySQLConnection(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DATABASE),
    new InputData()
);