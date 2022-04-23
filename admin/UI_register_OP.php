<?php
    session_start();
    require_once('../php/classes/payrollClass.php');
    $classPayroll->register_op();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Reg_op.css">
    <title>Register</title>
</head>
 <header>
    <?php

        if(isset($_SESSION['User']))
        {
            echo '<a href="logout_admin.php?logout">Logout</a>';
        }
        else
        {
            header("location:../index_AD.php");
        }

    ?>
    
 </header>
<style> * { text-align: center ;} </style>

<body>
    <!-- REGISTER OPERATOR -->
    <div class="container">
        <h1>Register Operator</h1>
        <form action="" method="post">
            <div class="container-content">
                <label class="email">Email:</label>
                <input type="email" name="op_email" placeholder="@email.com" id="op_email" required>
                <span></span>
            <div class="container-content">   
                <label class="pass">Password:</label>
                <input type="text" name="op_pass" placeholder="Password" id="op_pass" required>
                <span></span>
            </div>
            <div class="container-content">  
                <label class="fn">First Name:</label>
                <input type="text" name="op_fn" placeholder="Arjay" id="op_fn" required>
                <span></span>
            </div>   
            <div class="container-content">
                <label class="mn">Middle Name:</label>
                <input type="text" name="op_mn" placeholder="Aripal" id="op_mn" required>
                <span></span>
            </div>
            <div class="container-content">    
                <label class="ln">Last Name:</label>
                <input type="text" name="op_ln" placeholder="Laurito" id="op_ln" required>    
                <span></span>
            </div class="container-content">
            <div class="btn">
                 <button class="reg_btn" type="submit" name="add_op">Create Account</button>
            </div> 
        </form>
    </div>

</body>
</html>