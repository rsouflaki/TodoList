<?php
require_once 'connection.php';

if (isset($_POST['user-action'])) 
{
    switch ($_POST['user-action']) 
    {
        case 'Login':
            echo "skata";
            echo $_POST['email'];
            break;

        case 'Logout':
            session_start();
            session_unset();
            session_destroy();

            header("Location: login.php");
            break;    
        
    }
}
?>