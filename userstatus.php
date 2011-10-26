<?php
    require_once 'connection.php'; 
    session_start();

    if (isset($_SESSION['email']))
    {
        outputLogoutBox();
    }
    else
    {
        outputLoginBox();
    }
    
    function outputLoginBox()
    {
        ?>
        <form method="post" action="<?php echo htmlentities('login.php'); ?>">
            <p>E-mail Address:<input type="text" name="email" maxlength="255" value="">
               Password:<input type="password" name="passwd" maxlength="50" value="">
               <input type="submit" name="login" value="Login"></p>
        </form>               
        <?php
    }
    
    function outputLogoutBox()
    {
        ?>
        <form method="post" action="<?php echo htmlentities('logout.php'); ?>">
            <p><?php echo ($_SESSION['email'])?>
               <input type="submit" name="logout" value="Logout"></p>
        </form>        
        <?php
    }
    
?>