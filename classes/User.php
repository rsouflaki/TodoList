<?php
require_once 'Database.php';

class User
{
    public $mId;
    public $mEmail;
    public $mPassword;
    public $mFirstName;
    public $mLastName;
    public $mAge;
    public $mAccessLevelId;
    
    function __construct($id, $email, $password, $firstName, $lastName, $age, $accessLevelId) {
        $this->mId = $id;
        $this->mEmail = $email;
        $this->mPassword = $password;
        $this->mFirstName = $firstName;
        $this->mLastName = $lastName;
        $this->mAge = $age;
        $this->mAccessLevelId = $accessLevelId;
    }
    
    function isUser(String $email) 
    {
        return true;
    }
    
    function insertInDatabase()
    {
    }
    
    static function getUserFromDatabase($email, $password)
    {
        $sqlCommand = "SELECT * FROM User WHERE Email='$email' AND Password='$password'";
        $result = Database::get()->query($sqlCommand);    
        if ($result)
        {
            if ($row = mysqli_fetch_array($result))
            {
                $user = new User($row['UserId'], $row['Email'], $row['Password'], $row['FirstName'], $row['LastName'], $row['Age'], $row['AccessLevelId']);
                return $user;
            }
        }
        return null;
    }
}
?>