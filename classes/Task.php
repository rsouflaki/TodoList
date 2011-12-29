<?php
require_once 'Database.php';

class Task
{
    public $mId;
    public $mTaskName;
    public $mEstimation;
    public $mListId;

    public function __construct($id, $taskName, $estimation, $listId)
    {
        $this->mId = $id;
        $this->mTaskName = $taskName;
        $this->mEstimation = $estimation;
        $this->mListId = $listId;
    }

    // returns an array of todolists for a specific user
    public static function getTasksFromDatabase($listId)
    {
        $sqlCommand = "SELECT * FROM Task WHERE ListId='$listId'";
        $result = Database::get()->query($sqlCommand);    
        if ($result)
        {
            $tasks = array();
            while($row = mysqli_fetch_array($result))
            {
                $tasks[] = new Task($row['TaskId'], $row['TaskName'], $row['Estimation'], $row['ListId']);
            }
            return $tasks;
        }
        return null;
    }
    
    public static function insertToDatabase($taskName, $estimation, $listId)
    {
        $sqlCommand = "INSERT INTO Task(TaskName, Estimation, ListId) VALUES ('$taskName', '$estimation', '$listId')";        
        $result = Database::get()->query($sqlCommand);
        if ($result) 
        {
            $taskId = Database::get()->insert_id;
            $task = new Task($taskId, $taskName, $estimation, $listId);
            return $task;
        }
        return null;
    }
}
?>