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
            createDB(SQL_DB, $conn);
            break;

        case 'delete':
            deleteDB(SQL_DB, $conn);
            break;
        
        case 'tables':
            createTables(SQL_DB, $conn);
            break;
            
        case 'drop':
            dropTables(SQL_DB, $conn);
            break;
            
        case 'insert':
            insertTestDataSet(SQL_DB, $conn);
            break;
    }
}

function createDB($dbName, $conn)
{
    $sql = <<<EOS
    CREATE DATABASE todo_db
EOS;
    $result = mysql_query($sql, $conn) 
        or die('Could not create database:' . mysql_error());
}

function deleteDB($dbName, $conn)
{
    $sql = <<<EOS
    DROP DATABASE todo_db
EOS;
    $result = mysql_query($sql, $conn) 
        or die('Could not delete database:' . mysql_error());
}

function createTables($dbName, $conn)
{
    mysql_select_db($dbName, $conn)
        or die('Could not select database; ' . mysql_error());
    
    $sql = <<<EOS
        CREATE TABLE IF NOT EXISTS AccessLevel (
        AccessLevelId tinyint(4) NOT NULL auto_increment,
        AccessName varchar(50) NOT NULL default '',
        PRIMARY KEY (AccessLevelId))
EOS;
    $result = mysql_query($sql)
        or die(mysql_error());

    $sql = "INSERT IGNORE INTO AccessLevel " .
        "VALUES (1,'User'), " .
        "(2,'Moderator'), " .
        "(3,'Administrator')";
    $result = mysql_query($sql) 
        or die(mysql_error());
  
    $sql = <<<EOS
        CREATE TABLE IF NOT EXISTS User (
        UserID int(11) NOT NULL auto_increment,
        Email varchar(30) NOT NULL,
        Password varchar(15) NOT NULL,
        FirstName varchar(20) NOT NULL,
        LastName varchar(25) NOT NULL,
        Age int NOT NULL,
        AccessLevelId tinyint(4) NOT NULL,
        PRIMARY KEY (UserID),
        UNIQUE KEY UniqEmail(Email),
        FOREIGN KEY (AccessLevelId) REFERENCES AccessLevel(AccessLevelId))
EOS;
    $result = mysql_query($sql, $conn) 
        or die('Could not create table:' . mysql_error());
    
    $sql = <<<EOS
        CREATE TABLE IF NOT EXISTS List (
        ListId int(11) NOT NULL auto_increment,
        ListName varchar(30) NOT NULL,
        UserID int(11) NOT NULL,
        PRIMARY KEY (ListId),
        FOREIGN KEY (UserID) REFERENCES User(UserID))
EOS;
    $result = mysql_query($sql, $conn) 
        or die('Could not create table:' . mysql_error());
    
    $sql = <<<EOS
        CREATE TABLE IF NOT EXISTS Task (
        TaskId int(11) NOT NULL auto_increment,
        TaskName varchar(100) NOT NULL,
        Estimation int(11) NOT NULL,
        ListId int(11) NOT NULL,
        PRIMARY KEY (TaskId),
        FOREIGN KEY (ListId) REFERENCES List(ListId))
EOS;
    $result = mysql_query($sql, $conn) 
        or die('Could not create table:' . mysql_error());
}

function dropTables($dbName, $conn)
{
    mysql_select_db($dbName, $conn)
        or die('Could not select database; ' . mysql_error());
}

function insertTestDataSet($dbName, $conn)
{
    mysql_select_db($dbName, $conn)
        or die('Could not select database; ' . mysql_error());
}

mysql_close($conn);
?>