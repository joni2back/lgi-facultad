<?php

require_once dirname(__FILE__) . '/constants.php';
require_once dirname(__FILE__) . '/mysqldb.php';
require_once dirname(__FILE__) . '/application.php';

error_reporting(E_ALL); //mostramos todos los errores en desarrollo
$app = new Application(new MySQLConnection());