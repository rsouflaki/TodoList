<?php require_once 'header.php'; ?>

<form method="post" action="user-actions.php" onsubmit="return checksignupform()">

    <h1>Member Signup</h1>
    
    <p>
        E-mail Address:</br>
        <input type="text" name="email" maxlength="255" value="">
    </p>
    <p>
        Password:</br>
        <input type="password" name="passwd" maxlength="50" value="">
    </p>
    <p>
        Repeat Password:</br>
        <input type="password" name="repeatpasswd" maxlength="50" value="">
    </p>
    <p>
        First Name:</br>
        <input type="text" name="firstname" maxlength="30" value="">
    </p>
    <p>
        Last Name:</br>
        <input type="text" name="lastname" maxlength="30" value="">
    </p>
    <p>
        Age:</br>
        <input type="text" name="age" maxlength="30" value="">
    </p>
    
    <p>
        Gender <input type="radio" name="sex" value="male" /> Male
               <input type="radio" name="sex" value="female" /> Female
    </p>
  
    <p>
        <input type="submit" name="user-action" value="Signup">
    </p>

    <p>
        <a href="forgotpass.php">Forgot your password?</a>
    </p>

</form>


<?php require_once 'footer.php'; ?>