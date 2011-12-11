<?php 
require_once 'header.php';
require_once '../classes/User.php';

if (isset($_SESSION['email']))
{
    header("Location: welcome.php");
}

if (!isset($_POST['signup']))
{
    outputSignupForm("");
}
else
{
    $errorMessage = processSignup();
    if ($errorMessage) //check if we have an error
    {
        outputSignupForm($errorMessage);
    }
    else
    {
        header("Location: welcome.php");
    }
}

function processSignup()
{
    if ((empty($_POST['email'])) || (empty($_POST['passwd'])) || (empty($_POST['repeatpasswd'])) || (empty($_POST['firstname'])) || 
        (empty($_POST['lastname'])) || (empty($_POST['age'])) || (empty($_POST['sex'])))
    {
        return "fill all the values"; //return errormessage 
    }
    else if ($_POST['passwd'] != $_POST['repeatpasswd'])
    {
        return "password mismatch";
    }
    else if (User::isEmailUsed($_POST['email']))
    {
        return "email is already used";
    }
    else
    {
        $user = User::insertToDatabase($_POST['email'], $_POST['passwd'], $_POST['firstname'], $_POST['lastname'], $_POST['age']);
        if (!$user)
        {
            return "creating user failed";
        } 
        else {
            $_SESSION['userId'] = $user->mId;
            $_SESSION['email'] = $user->mEmail;
            $_SESSION['firstName'] = $user->mFirstName;
            return "";
        }
    }
}

function outputSignupForm($err)
{
    if ($err)
    {
        echo "Error: " . $err;
    }
    ?>
    <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" onsubmit="return checksignupform()"> 
    <!--checksignupform is a javascript function from an external file called in the header-->
        <h1>Member Signup</h1>
        <p>E-mail Address:</br><input type="text" name="email" maxlength="255" value="" onChange="checkEmail()"> <div id="emailCheck"></div></p>
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
