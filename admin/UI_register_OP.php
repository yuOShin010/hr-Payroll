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
    <link rel="stylesheet" href="../css/registration.css">
    <title>Registration</title>
</head>
 <header class="tophead">
    <?php

    if (isset($_SESSION['User'])) {
    echo '<a href="../logout.php?logout"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 logout" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
    </svg></a>'; ?><?php

    } else {
        header("location:../index.php");
    }

    ?>
    
 </header>

<body>
    <!-- REGISTER OPERATOR -->
    <div class="container"></div>
    <div class="container2">
        <h1>Register Operator</h1>
        <form action="" method="post">
            <div class="container-content">
                <label>
                    <input class="box-sized" type="email" name="op_email" placeholder="@email.com" id="op_email" required>
                    <p>Email</p>
                </label>          
                <label>
                    <input class="box-sized" type="text" name="op_pass" placeholder="Password" id="op_pass" required>
                    <p>Password</p>
                </label>
                <label>
                    <input class="box-sized" type="text" name="op_fn" placeholder="Jayson" id="op_fn" required>
                    <p>First Name </p>
                </label>
                <label>
                    <input class="box-sized" type="text" name="op_mn" placeholder="Balate" id="op_mn" required>
                    <p>Middle Name</p>
                </label>
                <label>
                    <input class="box-sized" type="text" name="op_ln" placeholder="Garcia" id="op_ln" required>    
                    <p>Last Name</p>
                </label>
                <div class="btn">
                    <button class="reg-btn" type="submit" name="add_op">Create Account</button>
                </div> 
            </div>
        </form>
    </div>

</body>
</html>