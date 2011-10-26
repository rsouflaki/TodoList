<?php
    session_start();
    $cookieSession = false;
    $postSession = false;
    if(($_COOKIE['PHPSESSID']))
    {
        $cookieSession = true;
    }
    if (defined('SID'))
    {
        $postSession = true;
    }

    if ((!$cookieSession && !$postSession) || $_SESSION['authenticated'] != 1) {
        header("Location:  login.php");
    }
    if ($cookieSession) {
        echo 'The session ID has been store in a cookie<br />';
    }
    if ($postSession) {
        echo 'The session ID has been stored in the query string<br />';
    }
    
    foreach($_SESSION as $key=>$value)
    {
        // and print out the values
        echo 'The value of $_SESSION['."'".$key."'".'] is '."'".$value."'".' <br />';
    }
    foreach($_COOKIE as $key=>$value)
    {
        // and print out the values
        echo 'The value of $_COOKIE['."'".$key."'".'] is '."'".$value."'".' <br />';
    }
?>