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
    <script src="http://kit.fontawesome.com/a076d05399.js"></script>    
    <title>Symtech Homepage</title>
</head>
 <header>
    <?php 

        if(isset($_SESSION['User']))
        {
            echo '<div class="welcome">'.'<h1>'.' Welcome ' . $_SESSION['User'].'</h1>'.'<div>';
            echo '<a href="logout_OP.php?logout">Logout</a>';
            // logout button (palagay nalang ako tas tanggalin mo nalang yung commnent nato hehe)
            echo '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>';
         }
        else
        {
            header("location:../index_OP.php");
        }

    ?>
 </header>
<body>
        <nav>
            <input type="checkbox" id="check">
            <label for="check" class="check-btn">
                <i class="fas fa-bars"></i>
            </label>

            <header>
                <ul>
                    <li><a class="active" href="#">Roles</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Company Info</a></li>
                </ul>
            </header>
        </nav>

        <h1 class="home-page-text">Symtech | Payroll Management System</h1>
        <div class="front"> 
            <button><a href="UI_addEmployee.php">Getting Started</a></h3></button>
        </div

    
</body>
</html>