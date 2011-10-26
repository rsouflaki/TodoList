<?php 
    session_start();
    require_once 'header.php';
    require_once 'menubar.php';

    echo $_SESSION['firstName']; 



?>