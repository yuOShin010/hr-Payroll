<?php
    session_start();

    if(isset($_SESSION['User']))
    {
        echo '<h1>'.' Welcome ' . $_SESSION['User'] . '</h1>'.'<br/>';
        echo '<a href="../logout.php?logout">Logout</a>';
    }
    else
    {
        header("location:../index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin DashBoard</title>
</head>
<body>
    <a href="UI_register_OP.php">Register</a> 
</body>
</html>