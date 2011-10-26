<?php
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
    
    echo $username . " ";
    
    if (isset($_POST['Start']))
    {
        header("Location: start.php");
    }
    
    if (isset($_POST['AddTask']))
    {
        $task = $_POST['task'];
        $time = $_POST['time'];
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
        echo $personID . " ";
        
        $sqlCommand = "INSERT INTO Tasks (PersonID, Task, Time) 
                       VALUES ('$personID','$task','$time')";
                       
        $retValue = mysql_query($sqlCommand, $con);

        if ($retValue)
        {
            echo "etoimos";
        }
        else
        {
            echo "Error: " . mysql_error();
        }
           
        mysql_close($con);

    }

    
?>

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<link rel="stylesheet" type="text/css" href="" />
	</head>

	<body>
        <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"> 
            Task <input type="text" name="task"> 
            <br /> 
            Time <input type="text" name="time">            
            <br />
            <input type="submit" name="AddTask" value="Add Task">
            <input type="submit" name="Start" value="Start Page">

        </form>    
    
    
    
    </body>

</html>