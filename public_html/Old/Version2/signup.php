<?php
    
    if (isset($_POST['SignUp']))
    {
        $username = $_POST['Username'];
        $password = $_POST['Password'];
        $firstname = $_POST['FirstName'];
        $lastname = $_POST['LastName'];
        $age = $_POST['Age'];
        $sex = $_POST['Sex'];
        
        $con = mysql_connect("localhost","root","pasok");
        if (!$con)
        {
            die('Could not connect: ' . mysql_error());
        }
        
        mysql_select_db("todo_db", $con);

        $sqlCommand = "INSERT INTO Users (Username, Password, FirstName, LastName, Age, Sex) 
                       VALUES ('$username','$password','$firstname','$lastname','$age','$sex')";
        $retValue = mysql_query($sqlCommand, $con);
        

        if ($retValue)
        {
            echo "etoimos";
        }
        else
        {
            echo "Error: " . mysql_error();
        }
                
    mysql_close($con);

    
    }


?>
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<link rel="stylesheet" type="text/css" href="" />
	</head>

	<body>
        <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"> 
            Username <input type="text" name="Username"> 
            <br /> 
            Password <input type="password" name="Password">            
            <br />
            Repeat Password <input type="password" name="Password2">            
            <br />
            First Name <input type="text" name="FirstName"> 
            <br />
            Last Name <input type="text" name="LastName"> 
            <br />
            Age <input type="text" name="Age"> 
            <br />        
            Gender <input type="radio" name="Sex" value="male" /> Male
                   <input type="radio" name="Sex" value="female" /> Female
            <input type="submit" name="SignUp" value="Sign Up">
        </form>    
    
    
    
    </body>

</html>