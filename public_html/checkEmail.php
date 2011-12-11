<?php 
require_once '../classes/User.php';

//get the username  
$email = mysql_real_escape_string($_POST['email']);  
if (User::isEmailUsed($email))
{
    // username is not available, return 0 to ajax request
    echo 0;
}
else
{
    // username is available, return 1
    echo 1;
}
?>
