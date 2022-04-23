<?php
    session_start();
    require_once('../php/classes/payrollClass.php');
    $pdo = $classPayroll->openConnection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css">
    <title>Symtech Homepage</title>
</head>
 <header>
    <?php 

        if(isset($_SESSION['User']))
        {
            echo '<h1>'.' Welcome ' . $_SESSION['User'].'</h1>';
            echo '<a href="logout_OP.php?logout">Logout</a>';
        }
        else
        {
            header("location:../index_OP.php");
        }

    ?>
 </header>
<body>
    
    <div class="front">
        
        <h1> Welcome to Symtech's HR payroll</h1><hr>
        <h3><a href="UI_addEmployee.php">Getting Started</a></h3>
    </div>
</body>
</html>