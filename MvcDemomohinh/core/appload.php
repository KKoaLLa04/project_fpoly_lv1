<?php
defined('APPPATH') or exit('Không được quyền truy cập phần này');

// Include file config/database
require CONFIGPATH . DIRECTORY_SEPARATOR . 'database.php';

// Include file config/config
require CONFIGPATH . DIRECTORY_SEPARATOR . 'config.php';

// Include core database
require LIBPATH . DIRECTORY_SEPARATOR . 'database.php';

// Include core base
require COREPATH . DIRECTORY_SEPARATOR . 'base.php';


// db_connect_pdo($db);
// connect database pdo
global $config;
// Kết nối db
try {
    $dsn = 'mysql:dbname=' . $db['database'] . ';host=' . $db['hostname'];

    $options = [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    $conn = new PDO($dsn, $db['username'], '', $options);

    // self::$conn = $con;
} catch (Exception $exception) {
    $mess = $exception->getMessage();

    die($mess);
}

require COREPATH . DIRECTORY_SEPARATOR . 'router.php';
