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
    <link rel="stylesheet" href="css/loginOP.css">
    <title>Login Operator | Symtech</title>
   
    
</head>

<body id="body1">
    
    <div class="container">

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
        <form action="" method="post">
        <p id="p1"><img src="https://cdn-icons-png.flaticon.com/512/7211/7211060.png" alt="logo"></p>
        <p>Operator</p>
        <div class="container-content">
            <input class="us" type="text" name="op_username" id="op_username" placeholder="Username"><br><br>
            <input class="pw" type="password" name="op_password" id="op_password" placeholder="Password"><br>
            <input class="check-box" type="checkbox" onclick="myFunction()">Show Password <br><br>            <!--  this checkbox is for show password -->   
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
        </script>


</html>


