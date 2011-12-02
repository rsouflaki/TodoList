<?php 
    require_once 'header.php';
    require_once 'menubar.php';
    require_once 'userstatus.php';

    if (!isset($_SESSION['email']))
    {
        header("Location: start.php");
    }
    else
    {
        $email = $_SESSION['email'];
        $sqlCommand = "SELECT * FROM Tasks WHERE Email='$email'";
        $result = mysql_query($sqlCommand, $conn);           
        if (!$result)
        {
            return mysql_error();
        }
        else
        {
            $num=mysql_num_rows($result);
            //dont use mysql_fetch_array for the test, because it verifies the 1st row and jumps to the 2nd
            if ($num == 0)
            {
                echo "You have no tasks";
            }
            else
            {
                echo "<table border='1'>
                      <tr>
                      <th>Task</th>
                      <th>Time</th>
                      </tr>";
            
                while($row = mysql_fetch_array($result))
                {
                    echo "<tr>";
                    echo "<td>" . $row['Task'] . "</td>";
                    echo "<td>" . $row['Time'] . "</td>";
                    echo "</tr>";
                }
                
                echo "</table>";
            }
        }
    }
        
    require_once 'footer.php';

?>