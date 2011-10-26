<?php 

    $errormessage = "";
    if (isset($_POST['logout']))
    {
        // Begin the session
        session_start();
        // Unset all of the session variables.
        session_unset();
        // Destroy the session.
        session_destroy();
        $errormessage = "Log out successful";
    }
    else if (isset($_POST['name']) && isset($_POST['pass']))
    {
        if (empty($_POST['name']) || empty($_POST['pass'])) 
        {
            // are the values filled in?
            $errormessage = "Fill in the boxes!";
        } 
        else 
        {
            // form submitted 
            // check for required values
            $con = mysql_connect("localhost","root","pasok");
            if (!$con)
            {
                die('Could not connect: ' . mysql_error());
            }
            mysql_select_db("todo_db", $con);
            $username = $_POST['name'];
            $password = $_POST['pass'];
            
            $sqlCommand = "SELECT * FROM Users WHERE Username='$username' AND Password='$password'";
            $result = mysql_query($sqlCommand, $con);           
            $numRows = mysql_num_rows($result);
            mysql_close($con);
            if ($numRows == 1)
            {
                // authentication was successful 
                // create session
                session_start(); 
                $sid = session_id();
                $_SESSION['authenticated'] = 1; 
                $_SESSION['username'] = $username;
                $_SESSION['time'] = time();
                setcookie("language", 'Greek', time()+(86400*30)); 
                setcookie("username", $user, time()+(86400*30)); 
                header("Location: start.php");
            } 
            else
            {
                $errormessage = "Wrong Users!";
            }
        }
    }
    else
    {
        $errormessage = "Καλώς ήρθες ξένε!";
    }

    
    $username = "";
    if (isset($_COOKIE['username'])) 
    {
        $username = $_COOKIE['username'];
    }
?> 

<!--FIXME: add Javascript to check that username and pasword are filled in-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head></head> 
    <body> 
        <center> 
        <h1> <?php echo $errormessage ?> </h1>
        <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"> 
            Username <input type="text" name="name" value="<?php echo $username; ?>"> 
            <br /> 
            Password <input type="password" name="pass"> 
            <br /> 
            <input type="submit" name="submit" value="Log In">
        </form>
        </center> 
    </body> 
</html> 