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
    
    static function isEmailUsed($email)
    {
        $sqlCommand = "SELECT * FROM User WHERE Email='$email'";
        $result = Database::get()->query($sqlCommand);    
        if ($result)
        {
            if ($row = mysqli_fetch_array($result))
            {
                return true;
            }
        }
        return false;
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
    
    static function insertToDatabase($email, $password, $firstName, $lastName, $age)
    {
        $accessLevelId = 1; // normal user, can't insert an admin from this API
        $sqlCommand = "INSERT INTO User(Email, Password, FirstName, LastName, Age, AccessLevelId) VALUES ('$email', '$password', '$firstName', '$lastName', $age, 1)";        
        $result = Database::get()->query($sqlCommand);
        if ($result) 
        {
            $userId = Database::get()->insert_id;
            $user = new User($userId, $email, $password, $firstName, $lastName, $age, $password, $accessLevelId);
            return $user;
        }
        return null;
    }
}
?>