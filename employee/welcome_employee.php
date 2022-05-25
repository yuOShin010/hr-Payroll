<?php
    session_start();

    if(isset($_SESSION['User']))
    {
        echo '<p>'.' Welcome Employee ' . '<strong style="font-size: 25px;">' . $_SESSION['User'] . '</strong>' . '</p>' ;
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
    <title>Welcome Employee Page</title>
</head>
<body>

</body>
</html>