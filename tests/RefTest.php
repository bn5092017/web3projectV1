<?php
/**
 *Test class for Ref methods
 */

namespace ItbTest;

Use Itb\Ref;
class RefTest extends \PHPUnit_Framework_TestCase
{
    public function testConnectionToDatabase()
    {
        //Arrange
        $r = new Ref();
        define('DB_HOST', 'localhost');
        define('DB_NAME', 'web3project');
        define('DB_USER', 'fred');
        define('DB_PASS', 'blckD0g');

        //Act
        $conn = $r->connectToDb();

        //Assert
        $this->assertNotNull($conn);
    }

    public function testCanGetAllRefs()
    {
        //Arrange
        $r = new Ref();

        //Act
        $refs = $r->getAllRefs();

        //Assert
        $this->assertNotNull($refs);
    }

    public function testCanGetOneRefById()
    {
        //Arrange
        $r = new Ref();

        //Act
        $ref = $r->getOneRefById(2);

        //Assert
        $this->assertNotNull($ref);
    }

    public function testCanGetAllRefsForUserWithThisId()
    {
        //Arrange
        $r = new Ref();

        //Act
        $refs = $r->getAllRefsForUser(3);

        //Assert
        $this->assertNotNull($refs);
    }
}