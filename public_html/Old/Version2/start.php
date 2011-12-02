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
    
    $con = mysql_connect("localhost","root","pasok");
    if (!$con)
    {
        die('Could not connect: ' . mysql_error());
    }    
    
    mysql_select_db("todo_db", $con);
    
    $sqlCommand = "SELECT PersonID FROM Users WHERE Username='$username'";
    
    $result = mysql_query($sqlCommand, $con);
    
    $personID = 0;
    
    while($row = mysql_fetch_array($result))
    {
        $personID = $row['PersonID'];
    }
    
    echo $personID . "<br/>";
    
    $sqlCommand = "SELECT * FROM Tasks WHERE PersonID='$personID'";
    
    $result = mysql_query($sqlCommand, $con);
    $numRows = mysql_num_rows($result);
    if ($numRows != 0)
    {
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<link rel="stylesheet" type="text/css" href="" />
	</head>

	<body>
        <h1> Welcome <?php echo $username; ?> </h1>
        <table>
            <tr>
				<th>Έργο</th>
				<th>Χρόνος</th>
			</tr>

<?php               
        while($row = mysql_fetch_array($result))
        {
            echo "<tr><td>" . $row['Task'] . "</td><td>" . $row['Time'] . "</td></tr>";
        }
    }
    else
    {
        echo "No Tasks Yet!";
    }
    
    mysql_close($con);
?>


        </table>
        
        <?php

            echo '<a target="_blank" href="session.php?' . $sid . '">Check Session</a>';
            echo '<br>';
            echo '<a target="_blank" href="session.php">Check Cookie</a>';
        ?>
        
        <form method="post" action="addtasks.php">
            <input type="Submit" name="AddNewTasks" value="Add New Tasks">
        </form>
        
        <form method="post" action="login.php">
            <input type="Submit" name="logout" value="Logout">
        </form>
        
    </body>

</html>
