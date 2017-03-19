<?php


namespace ItbTest;

use Itb\User;
class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testConnectionToDatabase($id, $username, $password, $firstName, $lastName, $role, $status, $image)
    {
        //Arrange
        $u = new User($id, $username, $password, $firstName, $lastName, $role, $status, $image);
        define('DB_HOST', 'localhost');
        define('DB_NAME', 'web3project');
        define('DB_USER', 'fred');
        define('DB_PASS', 'blckD0g');

        //Act
        $conn = $u->connectToDb();

        //Assert
        $this->assertNotNull($conn);
    }

    public function testCanCreateNewUserWithConstructor()
    {
        //Arrange
        $id = null;
        $username = 'testUser';
        $password = '1234';
        $firstName = 'Test';
        $lastName = 'User';
        $role = 'student';
        $status = 'private';
        $image = 'image.jpg';
        define('DB_HOST', 'localhost');
        define('DB_NAME', 'web3project');
        define('DB_USER', 'fred');
        define('DB_PASS', 'blckD0g');

        //Act
        $u = new User($id, $username, $password, $firstName, $lastName, $role, $status, $image);

        //Assert
        $this->assertNotNull($u);
    }

    /**
     * @depends testCanCreateNewUserWithConstructor
     * @param $id
     * @param $username
     * @param $password
     * @param $firstName
     * @param $lastName
     * @param $role
     * @param $status
     * @param $image
     */
    public function testCanGetAllUsers($id, $username, $password, $firstName, $lastName, $role, $status, $image)
    {
        //Arrange
        $u = new User($id, $username, $password, $firstName, $lastName, $role, $status, $image);

        //Act
        $users = $u->getAllUsers();

        //Assert
        $this->assertNotNull($users);
    }

    public function testCanGetOneUser($id, $username, $password, $firstName, $lastName, $role, $status, $image)
    {
        //Arrange
        $u = new User($id, $username, $password, $firstName, $lastName, $role, $status, $image);

        //Act
        $user = $u->getOneUser('tiff');

        //Assert
        $this->assertNotNull($user);
    }
}