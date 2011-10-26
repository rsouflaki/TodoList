<?php 
    require_once 'connection.php';

    if (!isset($_POST['signup']))
    {
        outputSignupForm("");
    }
    else
    {
        $errorMessage = processSignup($conn);
        if ($errorMessage) //check if we have an error
        {
            outputSignupForm($errorMessage);
        }
        else
        {
            header("Location: login.php");
        }
    }

    function processSignup($connection)
    {
        if ((empty($_POST['email'])) || (empty($_POST['passwd'])) || (empty($_POST['repeatpasswd'])) || (empty($_POST['firstname'])) || 
            (empty($_POST['lastname'])) || (empty($_POST['age'])) || (empty($_POST['sex'])))
        {
            return "fill all the values"; //return errormessage 
        }
        else
        {
            if ($_POST['passwd'] != $_POST['repeatpasswd'])
            {
                return "password mismatch";
            }
            else
            {
                $email = $_POST['email'];
                $sqlCommand = "SELECT * FROM Users WHERE Email='$email'";
                $result = mysql_query($sqlCommand, $connection);           
                if (!$result)
                {
                    return mysql_error();
                }
                else
                {
                    if ($row = mysql_fetch_array($result))
                    {
                        return "User Already Exists!";
                    }
                    else
                    {   
                        $password = $_POST['passwd'];
                        $firstname = $_POST['firstname'];
                        $lastname = $_POST['lastname'];
                        $age = $_POST['age'];
                        $sex = $_POST['sex'];
                        
                        $sqlCommand = "INSERT INTO Users (Email, Password, FirstName, LastName, Age, Sex) 
                                       VALUES ('$email','$password','$firstname','$lastname','$age','$sex')";
                        $result = mysql_query($sqlCommand, $connection);            
                        if (!$result)
                        {
                            return mysql_error();
                        }
                        session_start();
                        $_SESSION['email'] = $email;
                        $_SESSION['firstName'] = $firstname;
                    }
                }
            }
        }
    }

    function outputSignupForm($err)
    {
        require_once 'header.php';
        require_once 'menubar.php';
        if ($err)
        {
            echo "Error: " . $err;
        }
        ?>
        <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" onsubmit="return checksignupform()"> 
        <!--checksignupform is a javascript function from an external file called in the header-->
            <h1>Member Signup</h1>
            <p>E-mail Address:</br><input type="text" name="email" maxlength="255" value=""></p>
            <p>Password:</br><input type="password" name="passwd" maxlength="50" value=""></p>
            <p>Repeat Password:</br><input type="password" name="repeatpasswd" maxlength="50" value=""></p>
            <p>First Name:</br><input type="text" name="firstname" maxlength="30" value=""></p>
            <p>Last Name:</br><input type="text" name="lastname" maxlength="30" value=""></p>
            <p>Age:</br><input type="text" name="age" maxlength="30" value=""></p>
            <p>Gender <input type="radio" name="sex" value="male" /> Male
                      <input type="radio" name="sex" value="female" /> Female</p>
            <p><input type="submit" name="signup" value="Signup"></p>
        </form>
        <?php
            require_once 'footer.php'; 
    }
?>