<?php
require_once 'Database.php';

class TodoList
{
    public $mId;
    public $mListName;
    public $mUserId;
    
    /*function __construct() {
        $mId = NULL;
        $mListName = NULL;
        $mUserId = NULL;
    }*/
    
    public function __construct($id, $listName, $userId)
    {
        $this->mId = $id;
        $this->mListName = $listName;
        $this->mUserId = $userId;
    }

    // returns an array of todolists for a specific user
    public static function getListsFromDatabase($userId)
    {
        $sqlCommand = "SELECT * FROM List WHERE UserId='$userId'";
        $result = Database::get()->query($sqlCommand);    
        if ($result)
        {
            $lists = array();
            while($row = mysqli_fetch_array($result))
            {
                $lists[] = new TodoList($row['ListId'], $row['ListName'], $row['UserId']);
            }
            return $lists;
        }
        return null;
    }
    
    public static function insertToDatabase($listName, $userId)
    {
        $sqlCommand = "INSERT INTO List(ListName, UserId) VALUES ('$listName', '$userId')";        
        $result = Database::get()->query($sqlCommand);
        if ($result) 
        {
            $listId = Database::get()->insert_id;
            $list = new TodoList($listId, $listName, $userId);
            return $list;
        }
        return null;
    }
}
?>