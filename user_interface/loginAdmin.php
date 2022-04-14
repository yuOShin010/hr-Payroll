<?php
    require_once "../php/classes/payrollClass.php";
    $classPayroll->loginAdmin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/loginpage.css">
    
    <title>Login | Symtech</title>
</head>

<body id="body1">

    <div id="login" class="div-login">
        <form action="" method="post" class="form1">
                <img class="passlogo" src="https://img.icons8.com/external-colours-bomsymbols-/2x/external-admin-car-engine-dashboard-lights-full-colors-set-2-colours-bomsymbols-.png" alt="logo">
                <input class="text1" type="text" name="username1" id="username2" placeholder="Username"><br><br>
                <img class="adminlogo" src="https://img.icons8.com/pastel-glyph/2x/user-male-circle.png" alt="logo">
                <input class="text2" type="password" name="password1" id="password2" placeholder="Password"><br><br>
                <button type="submit" name="submit1" id="login-button"> Login </button>
        </form>
    </div>
    
</body>
</html>
