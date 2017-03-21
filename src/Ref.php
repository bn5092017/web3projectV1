<?php
/**
 *Itb Ref class
 */

namespace Itb;


class Ref
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

    public function getAllRefs()
    {
        $connection = $this->connectToDb();

        $sql = 'SELECT * FROM ref';

        $statement = $connection->query($sql);
        $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $statement;
    }

    public function getOneRefById($id)
    {
        $connection = $this->connectToDb();

        $sql = $connection->prepare('SELECT * FROM ref WHERE id=:id');

        $sql->execute([':id' => $id]);
        $statement = $sql->fetch(\PDO::FETCH_ASSOC);

        return $statement;
    }

    public function getAllRefsForUser($userId)
    {
        $connection = $this->connectToDb();

        $sql = $connection->prepare('SELECT * FROM ref WHERE userId=:userId');

        $sql->execute([':userId' => $userId]);
        $statement = $sql->fetchAll(\PDO::FETCH_ASSOC);

        return $statement;
    }

    public function createNewRef($userId, $authors, $title, $year, $publisher, $placeOfPub, $pages, $textSummary, $status)
    {
        $connection = $this->connectToDb();

        $sql = $connection->prepare('INSERT INTO ref VALUES (NULL, :userId, :authors, :title, :year, :publisher, :placeOfPub, :pages, :textSummary, :status, NOW(), NOW())');

        $sql->execute([':userId' => $userId,
            ':authors' => $authors,
            ':title' => $title,
            ':year' => $year,
            ':publisher' => $publisher,
            ':placeOfPub' => $placeOfPub,
            ':pages' => $pages,
            ':textSummary' => $textSummary,
            ':status' => $status]);
        $affectedRows = $sql->rowCount();

        return $affectedRows;
    }

    public function deleteRefById($id)
    {
        $connection = $this->connectToDb();

        $sql = $connection->prepare('DELETE FROM ref WHERE id=:id');

        $sql->execute([':id' => $id]);
        $affectedRows = $sql->rowCount();

        return $affectedRows;
    }
}