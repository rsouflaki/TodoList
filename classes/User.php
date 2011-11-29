<? php
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
    
    function isUser(String $email) 
    {
        return true;
    }
    
    function insertInDatabase()
    {
    }
    
    function getFromDatabase(String $email, String $password)
    {
        
    }
}
?>