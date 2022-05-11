<?php
    require_once('php/classes/payrollClass.php');
    $classPayroll->loginOperator();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/index.css">
    <title>Login Operator | Symtech</title>
   
    
</head>

<body id="body1">
        
    <div class="container">    
        <div class="top-bar stacktop">
                <h1>SymTech</h1> <h1>.</h1> <h1>|</h1> <p>Payroll Management System</p>

                <ul>
                    <li>About</li>
                    <li>Feedback</li>
                    <li>Contact</li>
                </ul>
        </div>
            <?php
                if(@$_GET['Empty']==true)
                {
                    echo $_GET['Empty'];                                
                }

                if(@$_GET['Invalid']==true)
                {
                    echo $_GET['Invalid'];                            
                }
            ?>  

        <div class="first-text">
            <p>The</p>
            <p>right</p>
            <p>choice</p>
            <p>is</p>
            <p>your</p>
            <p>₱</p>
            <p>rice</p>
            
        </div>
        <form action="" method="post">
            <div class="form">
                 <div class="title">
                <h1>SymTech</h1> <h1>.</h1>
            </div>
            <div class="inside-form">
                <input type="text" name="op_username" id="op_username" placeholder="Username">
                <input type="password" name="op_password" id="op_password" placeholder="Password">
                <label>Show Password</label>
                <input class="check-box" type="checkbox" onclick="myFunction()"> <!--  this checkbox is for show password -->   
                <button class="login-btn" type="submit" name="op_login" id="login-button"> Login </button>
                <h6>Forgot Password?</h6>
            </div>
        </form>
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
            // $(document).ready(function(){
                
            //     var header = $(".stacktop");
            //     $(window).scroll(function(){
            //     var scroll = $(window).scrolTop();

            //         if(scroll >= 100) {
            //             header.removeClass("stacktop").addClass("darkheader");
            //         } else {
            //             header.removeClass("darkheader").addClass("stacktop");
            //         }
            //     });
            // });     
        </script>


</html>


