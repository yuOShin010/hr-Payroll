<?php
    session_start();

    if(isset($_SESSION['User']))
    {
        echo '<h1>'.' Welcome ' . $_SESSION['User'] . '</h1>'.'<br/>';
        echo '<a href="logout_admin.php?logout">Logout</a>';
    }
    else
    {
        header("location:../index_AD.php");
    }

?>