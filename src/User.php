<?php
/**
 * Itb User Class
 */

namespace Itb;


/**
 * Class User
 * @package Itb
 */
class User
{
    public function connect_to_db()
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

    public function getAllUsers()
    {
        $connection = $this->connect_to_db();
        if(null !=$connection)
        {
            print 'Success - connection to database created' . PHP_EOL;
        }else{
            print 'There was an error connecting to the database'. PHP_EOL;
        }

        $sql = 'SELECT * FROM user';

        $statement = $connection->query($sql);
        $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $statement;
    }
}