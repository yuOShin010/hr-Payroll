<?php
    require_once "php/classes/payrollClass.php";
    $classPayroll->loginAdmin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/loginpage.css">
    
    <title>Login Admin | Symtech</title>
</head>

<body id="body1">

    

    <div id="login" class="div-login">
        <h1><img src="https://cdn-icons-png.flaticon.com/512/7211/7211042.png" alt="logo"></h1>
        <p>Administrator</p>
            <form action="" method="post" class="form1">
            <div class="textbox">
                <!-- <img class="passlogo" src="https://img.icons8.com/external-colours-bomsymbols-/2x/external-admin-car-engine-dashboard-lights-full-colors-set-2-colours-bomsymbols-.png" alt="logo"> -->
                <input class="text" type="text" name="username1" id="username2" placeholder="Username"><br><br>
            </div>    
            <div class="textbox">
                <!-- <img class="adminlogo" src="https://img.icons8.com/pastel-glyph/2x/user-male-circle.png" alt="logo"> -->
                <input class="text" type="password" name="password1" id="password2" placeholder="Password"><br><br>
            </div>
            <div class="btn">
                <button class="login_btn" type="submit" name="submit1" id="login-button"> Login </button>
            </div>

        </form>
    </div>
    
</body>
<<<<<<< HEAD
=======

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

>>>>>>> e9395c0d407dbf039563c5fa4488b8748ffc61d3
</html>
