<?php 
    require_once 'header.php';
    require_once 'menubar.php';
    require_once 'userstatus.php';

    if (!isset($_SESSION['email']))
    {
        header("Location: start.php");
    }
    
    if (!isset($_POST['addtask']))
    {
        outputAddTaskForm("");
    }
    else
    {
        $errorMessage = processAddTask($conn);
        if ($errorMessage) //check if we have an error
        {
            outputAddTaskForm($errorMessage);
        }
        else
        {
            header("Location: start.php");
        }
    }
    
    function processAddTask($connection)
    {
        if ((empty($_POST['task'])) || (empty($_POST['time'])))
        {
            return "fill all the values"; //return errormessage
        }
        else
        {
            $email = $_SESSION['email'];
            $task = $_POST['task'];
            $time = $_POST['time'];
   
            $sqlCommand = "INSERT INTO Tasks (Email, Task, Time) 
                           VALUES ('$email','$task','$time')";
            $result = mysql_query($sqlCommand, $connection);           
            if (!$result)
                {
                    return mysql_error();
                }
        }
    }
    
    
    function outputAddTaskForm($err)
    {
        if ($err)
        {
            echo "Error!: " . $err;
        }
        ?>
        <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" onsubmit="return checkaddtaskform()">
        <!--checkaddtaskform is a javascript function from an external file called in the header-->
            <h1>Add a Task</h1>
            <p>Task Name:</br><input type="text" name="task" maxlength="255" value=""></p>
            <p>Time:</br><input type="text" name="time" maxlength="50" value=""></p>
            <p><input type="submit" name="addtask" value="Add Task"></p>
        </form>
        <?php 
            require_once 'footer.php';
    }
?>
