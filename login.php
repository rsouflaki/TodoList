<?php require_once 'header.php'; ?>
<?php require_once 'menubar.php'; ?>

   


<form method="post" action="user-actions.php" onsubmit="return checkform()">

    <h1>Member Login</h1>
    
    <p>
        E-mail Address:<br>
        <input type="text" name="email" maxlength="255" value="">
    </p>
    <p>
        Password:<br>
        <input type="password" name="passwd" maxlength="50" value="">
    </p>
    <p>
        <input type="submit" name="user-action" value="Login">
    </p>
    <p>
        <input type="submit" name="user-action" value="Logout">
    </p>
    <p>
        Not a member yet? <a href="signup.php">Create a new account!</a>
    </p>
    <p>
        <a href="forgotpass.php">Forgot your password?</a>
    </p>

</form>

<?php require_once 'footer.php'; ?>