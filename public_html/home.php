<?php
require_once 'header.php';
require_once '../classes/User.php';

session_start();

if (isset($_SESSION['email']))
{
    header("Location: welcome.php");
}

if (!isset($_POST['login']))
{
    outputLoginForm("");
}
else
{
    $errorMessage = processLogin();
    if ($errorMessage) //check if we have an error
    {
        outputLoginForm($errorMessage);
    }
    else
    {
        header("Location: welcome.php");
    }
}
 
function processLogin()
{
    if ((empty($_POST['email'])) || (empty($_POST['passwd'])))
    {
        return "fill all the values"; //return errormessage
    }
    else
    {
        $user = User::getUserFromDatabase($_POST['email'], $_POST['passwd']);
        if ($user)
        {
            $_SESSION['userId'] = $user->mId;
            $_SESSION['email'] = $user->mEmail;
            $_SESSION['firstName'] = $user->mFirstName;
            return;
        } 
        else {
            return "Could not find User!";
        }
    }
} 


function outputLoginForm($err)
{
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