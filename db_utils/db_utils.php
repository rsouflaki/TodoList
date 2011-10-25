<?php
define('SQL_HOST','localhost');
define('SQL_USER','root');
define('SQL_PASS','pasok');
define('SQL_DB','todo_db');

$conn = mysql_connect(SQL_HOST, SQL_USER, SQL_PASS)
  or die('Could not connect to the database; ' . mysql_error());
  
if (isset($_GET['action'])) 
{
    echo 'Processing action: ' . $_GET['action'];
    echo '</br>';
    switch ($_GET['action'])  
    {
        case 'create':
            createDB(SQL_DB);
            break;

        case 'delete':
            deleteDB(SQL_DB);
            break;
        
        case 'tables':
            createTables();
            break;
            
        case 'drop':
            dropTables();
            break;
            
        case 'insert':
            break;
    }
}

function createDB($dbName)
{
    $sql = <<<EOS
    CREATE DATABASE todo_db
EOS;
    $result = mysql_query($sql, $conn) 
        or die('Could not create database:' . mysql_error());
}

function deleteDB($dbName)
{
    $sql = <<<EOS
    DROP DATABASE todo_db
EOS;
    $result = mysql_query($sql, $conn) 
        or die('Could not delete database:' . mysql_error());
}

function createTables()
{
    $sql = <<<EOS
        CREATE TABLE IF NOT EXISTS AccessLevels (
        AccessLevel tinyint(4) NOT NULL auto_increment,
        AccessName varchar(50) NOT NULL default '',
        PRIMARY KEY (AccessLevel))
EOS;
    $result = mysql_query($sql)
        or die(mysql_error());

    $sql = "INSERT IGNORE INTO AccessLevels " .
        "VALUES (1,'User'), " .
        "(2,'Moderator'), " .
        "(3,'Administrator')";
    $result = mysql_query($sql) 
        or die(mysql_error());
  
    $sql = <<<EOS
        CREATE TABLE IF NOT EXISTS Users (
        UserID int(11) NOT NULL auto_increment,
        Email varchar(30) NOT NULL,
        Password varchar(15) NOT NULL,
        FirstName varchar(20) NOT NULL,
        LastName varchar(25) NOT NULL,
        Age int NOT NULL,
        AccessLevel tinyint(4) NOT NULL,
        PRIMARY KEY (UserID),
        UNIQUE KEY UniqEmail(Email))
EOS;
    $result = mysql_query($sql, $conn) 
        or die('Could not create table:' . mysql_error());
    
    //TODO: add more checks    
    //TODO: add more tables
}

mysql_close($conn);
?>