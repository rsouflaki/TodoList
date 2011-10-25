<?php
require_once 'connection.php';

if (isset($_POST['user-action'])) 
{
    switch ($_POST['user-action']) 
    {
        case 'Login':   //Called from Login Form
        
            if ((empty($_POST['email'])) || (empty($_POST['passwd'])))
            {
                echo "fill all the values";
                break;
            }
            else
            {
                $email = $_POST['email'];
                $password = $_POST['passwd'];
                $sqlCommand = "SELECT * FROM Users WHERE Email='$email' AND Password='$password'";
                $result = mysql_query($sqlCommand, $conn);           
                $numRows = mysql_num_rows($result);
                
                if ($numRows == 1)
                {
                    $row = mysql_fetch_array($result);  //Get values from user's row for a proper greeting
                    echo "Wellcome " . $row['FirstName'] . " " . $row['LastName'];
                    break;
                }
                else
                {
                    echo "Unknown User!";
                    break;
                }
            }

        case 'Logout':
            session_start();
            session_unset();
            session_destroy();

            header("Location: login.php");
            break;    
        
        case 'Signup':  //Called from Signup Form
        
            if ((empty($_POST['email'])) || (empty($_POST['passwd'])) || (empty($_POST['repeatpasswd'])) || (empty($_POST['firstname'])) || 
                (empty($_POST['lastname'])) || (empty($_POST['age'])) || (empty($_POST['sex'])))
            {
                echo "fill all the values";
                break; 
            }
            else
            {
                $email = $_POST['email'];
                $sqlCommand = "SELECT * FROM Users WHERE Email='$email'";
                $result = mysql_query($sqlCommand, $conn);           
                $numRows = mysql_num_rows($result);
                if ($numRows == 1)
                {
                    echo "User Already Exists!";
                    break;
                }
                else
                {   
                    $password = $_POST['passwd'];
                    $firstname = $_POST['firstname'];
                    $lastname = $_POST['lastname'];
                    $age = $_POST['age'];
                    $sex = $_POST['sex'];
                    
                    $sqlCommand = "INSERT INTO Users (Email, Password, FirstName, LastName, Age, Sex) 
                                   VALUES ('$email','$password','$firstname','$lastname','$age','$sex')";
                    $result = mysql_query($sqlCommand, $conn);            
            
                    if ($result)
                    {
                        echo "etoimos";
                    }
                    else
                    {
                        echo "Error: " . mysql_error();
                    }
                    
                    break;
                }
            }
    
    }
}
else
{
    header("Location: login.php");
}
?>