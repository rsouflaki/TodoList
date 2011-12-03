<?php 
require_once 'header.php';
require_once 'menubar.php';
require_once '../classes/Task.php';

session_start();
$errorMessage = "";

if (!isset($_SESSION['email']))
{
    header("Location: home.php");
}
else
{
    $userId = $_SESSION['userId'];
    $email = $_SESSION['email'];
    $listId = $_GET['list'];

    if (isset($_POST['addTask']))
    {
        // add new task to DB first, so the list will include it
        $errorMessage = processAddTask();
    }
    
    $tasks = Task::getTasksFromDatabase($listId);
    if (!$tasks)
    {
        echo 'Could not get any tasks';
    } 
    else 
    {
        echo "<table border='1'>
                  <tr>
                  <th>Task name</th>
                  <th>Estimation</th>
                  </tr>";
        
        // loop through the tasks arrray(contains Task objects) and store each element in task variable
        foreach ($tasks as $task)
        {
            echo "<tr>";
            echo "<td>$task->mTaskName</td>";
            echo "<td>$task->mEstimation</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    
    // show the add task dialog with or without error
    outputAddTaskForm($errorMessage);
}

function processAddTask()
{
    if ((empty($_POST['taskName'])) || (empty($_POST['estimation'])))
    {
        return "fill all the values"; //return errormessage
    }
    else
    {
        global $listId;
        $task = Task::insertToDatabase($_POST['taskName'], $_POST['estimation'], $listId);
        if (!$task)
        {
            return "creating task failed";
        } 
        else {
            return "";
        }
    }
} 


function outputAddTaskForm($err)
{
    if ($err)
    {
        echo "Error!: " . $err;
    }
    global $listId;
    ?>
    <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF'] . "?list=$listId"); ?>">
        <h3>Add new task</h3>
        Name:<input type="text" name="taskName" maxlength="255" value="">
        Estimation:<input type="text" name="estimation" maxlength="255" value="">
        <input type="submit" name="addTask" value="Submit">
    </form>
    
    <?php 
}
    
require_once 'footer.php';

?>