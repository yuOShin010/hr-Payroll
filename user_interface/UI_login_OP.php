<?php
    require_once('../php/classes/payrollClass.php');
    $classPayroll->loginOperator();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Operator | Symtech</title>
    <link rel="stylesheet" href="../css/loginOP.css">
</head>

<body id="body1">
    
    <div class="container">
            <h1 id="p1">OPERATOR</h1>
        <form action="" method="post">
        <div class="container-content">
            <input class="us" type="text" name="op_username" id="op_username" placeholder="Username"><br><br>
        </div>
        <div class="container-content">
            <input class="pw" type="password" name="op_password" id="op_password" placeholder="Password"><br>
        </div>
        <div class="container-content">
            <input class="check-box" type="checkbox" onclick="myFunction()">Show Password <br><br>            <!--  this checkbox is for show password -->   
        </div>
        <div class="container-content">
            <button class="login-btn" type="submit" name="op_login" id="login-button"> Login </button>
        </div>
        <h6>Forgot Password?</h6>
        </form>
    </div>
    <div class="container2">
        <div class="up">
            <h1>If you don't have an account yet you can <a href="UI_register_OP.php">Sign up</a> here.</h1>
        </div>
        <div class="down">
            <h1>or go back to the <a href="./dashboard.php"> Admin Dashboard</a></h1>
        </div>
    </div>

</body>


        <script>
            function myFunction() 
            {
                var x = document.getElementById("op_password");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }           
        </script>
</html>
