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
    public function connectToDb()
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

    public function __construct($id, $username, $password, $firstName, $lastName, $role, $status, $image)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->role = $role;
        $this->status = $status;
        $this->image = $image;

        $connection = $this->connectToDb();
        $sql = $connection->prepare('INSERT INTO user (id, username, password, firstName, lastName, role, status, image) VALUES (:id, :username, :password, :firstName, :lastName, :role, :status, :image)');

        $sql->execute([':id' => $id,
            ':username' => $username,
            ':password' => $password,
            ':firstName' => $firstName,
            ':lastName' => $lastName,
            ':role' => $role,
            ':status' => $status,
            ':image' => $image]);
        $rows = $sql->rowCount();

        print $rows . ' rows affected';
    }

    public function getAllUsers()
    {
        $connection = $this->connectToDb();

        $sql = 'SELECT * FROM user';

        $statement = $connection->query($sql);
        $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $statement;
    }

    public function getOneUser($username)
    {
        $connection = $this->connectToDb();

        $sql = $connection->prepare('SELECT * FROM user WHERE username=:username');

        $sql->execute([':username' => $username]);
        $statement = $sql->fetch(\PDO::FETCH_ASSOC);

        return $statement;
    }
}