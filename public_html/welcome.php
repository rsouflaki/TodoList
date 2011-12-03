<?php 
require_once 'header.php';
require_once 'menubar.php';
require_once '../classes/TodoList.php';

session_start();

if (!isset($_SESSION['email']))
{
    header("Location: home.php");
}
else
{
    $userId = $_SESSION['userId'];
    $email = $_SESSION['email'];
    $todoLists = TodoList::getListsFromDatabase($userId);
    if (!$todoLists)
    {
        echo 'Could not get any lists';
    } 
    else 
    {
        echo "<table border='1'>
                  <tr>
                  <th>List name</th>
                  </tr>";
        
        // loop through the list arrray(contains TodoList objects) and store each element in list variable
        foreach ($todoLists as $list)
        {
            echo "<tr>";
            echo "<td><a href='todolist.php?list=$list->mId'>$list->mListName</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}

if (!isset($_POST['addList']))
{
    outputAddTodoListForm("");
}
else
{
    $todoList = null;
    $errorMessage = processAddTodoList($todoList);
    if ($errorMessage) //check if we have an error
    {
        outputAddTodoListForm($errorMessage);
    }
    else
    {
        header("Location: todolist.php?list=$todolist->mId");
    }
}
 
function processAddTodoList($todoList)
{
    if ((empty($_POST['todoListName'])))
    {
        return "fill all the values"; //return errormessage
    }
    else
    {
        $todoList = TodoList::insertToDatabase($_POST['todoListName'], $_SESSION['userId']);
        if (!$todoList)
        {
            return "creating todo list failed";
        } 
        else {
            return "";
        }
    }
} 


function outputAddTodoListForm($err)
{
    if ($err)
    {
        echo "Error!: " . $err;
    }
    ?>
    <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
        <h3>Add new todo list</h3>
        <p>Name:</br><input type="text" name="todoListName" maxlength="255" value=""></p>
        <p><input type="submit" name="addList" value="Submit"></p>
    </form>
    
    <?php 
}
    
require_once 'footer.php';

?>