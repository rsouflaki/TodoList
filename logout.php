<?php
    session_start();

    if (!isset($_SESSION['email']))
    {
        header("Location: start.php");
    }
    
    if (isset($_POST['logout']))
    {
        session_unset();
        session_destroy();
        header("Location: start.php");
    }
    
?>