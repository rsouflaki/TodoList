<?php
    require_once 'connection.php'; 

    if (!isset($_POST['login']))
    {
        outputLoginForm("");
    }
    else
    {
        $errorMessage = processLogin($conn);
        if ($errorMessage) //check if we have an error
        {
            outputLoginForm($errorMessage);
        }
        else
        {
            header("Location: start.php");
        }
    }
     
    function processLogin($connection)
    {
        if ((empty($_POST['email'])) || (empty($_POST['passwd'])))
        {
            return "fill all the values"; //return errormessage
        }
        else
        {
            $email = $_POST['email'];
            $password = $_POST['passwd'];
            $sqlCommand = "SELECT * FROM Users WHERE Email='$email' AND Password='$password'";
            $result = mysql_query($sqlCommand, $connection);           
            if (!$result)
                {
                    return mysql_error();
                }
            else
            {
                if ($row = mysql_fetch_array($result))
                {
                    session_start();
                    $_SESSION['email'] = $row['Email'];
                    $_SESSION['firstName'] = $row['FirstName'];
                    return;
                }
                else
                {
                    return "Unknown User!";
                }
            }
        }
    } 


    function outputLoginForm($err)
    {
        require_once 'header.php';
        require_once 'menubar.php';
        if ($err)
        {
            echo "Error!: " . $err;
        }
        ?>
        <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" onsubmit="return checkloginform()">
        <!--checkloginform is a javascript function from an external file called in the header-->
            <h1>Member Login</h1>
            <p>E-mail Address:</br><input type="text" name="email" maxlength="255" value=""></p>
            <p>Password:</br><input type="password" name="passwd" maxlength="50" value=""></p>
            <p><input type="submit" name="login" value="Login"></p>
            <p>Not a member yet? <a href="signup.php">Create a new account!</a></p>
            <p><a href="forgotpass.php">Forgot your password?</a></p>
        </form>
        <?php 
            require_once 'footer.php';
    }
?>



