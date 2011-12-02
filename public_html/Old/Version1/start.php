<?php
    require("user.php");
    
    session_start();
    
    if ($_SESSION['authenticated'] != 1)
    {
        header("Location: login.php");
    }
    
    $username = "Unknown";
    
    if (isset($_SESSION['username']))
    {
        $username = $_SESSION['username'];
    }
    
    $sid = session_id();
    
    $todo1 = new Todo('skoupidia', 1);
    $todo2 = new Todo('piata', 2);
    $todo3 = new Todo('skoupisma', 3);
    $todo4 = new Todo('parathira', 4);
    
    $currentUser = new User($username, array($todo1, $todo2, $todo3, $todo4));
    //echo $currentUser->mTodos[0]->mTask . ' ' .  $currentUser->mTodos[0]->mTime;
    foreach ($currentUser->mTodos as $todoItem)
    {
        echo $todoItem->mTask . ' ' .  $todoItem->mTime . '<br/>';
    }
   
    //if ($username == "takis")
    //{
    //    $currentUser->mUsername = $username;
        
    //    $currentUser->mTodos = array($todo1, $todo2, $todo3, $todo4);
    //} 
    //else if ($username == "misos")
    //{
    
    //}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<link rel="stylesheet" type="text/css" href="" />
	</head>

	<body>
        <h1> Welcome <?php echo $username; ?>! </h1>
        <table>
			<tr>
				<th>Έργο</th>
				<th>Χρόνος</th>
			</tr>
            <tr>
				<td>Σκουπίδια</td>
				<td>1</td>
			</tr>
            <tr>
				<td>Πιάτα</td>
				<td>2</td>
			</tr>
            <tr>
				<td>Σκούπισμα</td>
				<td>1</td>
			</tr>
            <tr>
				<td>Παράθυρα</td>
				<td>2</td>
			</tr>
            <tr>
				<td>Ρούχα</td>
				<td>3</td>
			</tr>
        </table>
        
        <?php

            echo '<a target="_blank" href="session.php?' . $sid . '">Check Session</a>';
            echo '<br>';
            echo '<a target="_blank" href="session.php">Check Cookie</a>';
        ?>
        
        <form method="post" action="login.php">
            <input type="Submit" name="logout" value="Logout">
        </form>
        
    </body>

</html>
