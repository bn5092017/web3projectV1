<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'web3project');
define('DB_USER', 'fred');
define('DB_PASS', 'blckD0g');

require_once __DIR__ . '/../vendor/autoload.php';

function connect_to_db()
{
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
    try
    {
        $conn = new \PDO($dsn, DB_USER, DB_PASS);
    }
    catch (\PDOException $e)
    {
        print 'There was an error connecting to the database';
        return null;
    }
    return $conn;
}

$u = new \Itb\User();
$u->getAllUsers();

while($row = $u->getAllUsers())
{
    echo $row['username'] . PHP_EOL;
    echo $row['firstName'] . PHP_EOL;
    echo $row['lastName'] . PHP_EOL;
    echo $row['role'] . PHP_EOL;
}
