<?php
require_once('php/classes/payrollClass.php');
$classPayroll->loginUsers();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <link rel="stylesheet" href="./css/index.css">  -->
    <link rel="stylesheet" href="./css/login.css">
    <title>Login Operator | Symtech</title>


</head>

<body id="body1">

    <div class="container">
        <div class="nav-top">
            <h1 class="title-left">SymTech</h1>
            <h1 class="dot-left">.</h1>
            <h1 class="line-left">|</h1>
            <p class="par">Payroll Management System</p>

            <ul>
                <li>About</li>
                <li>Feedback</li>
                <li>Contact</li>
            </ul>
            <div style="clear:both"></div>

        </div>

        <!-- <div class="banner">
            <p class="frst">The</p>
            <p class="snd">right</p>
            <p class="thrd">choice</p>
            <p class="fth">is</p>
            <p class="f5th">your</p>
            <p class="sxth">₱</p>
            <p class="svth">rice</p>
        </div> -->

        <div class="form">
            <form action="" method="post">
                <div class="form-title">
                    <h1>SymTech</h1>
                    <h1>.</h1>
                </div>

                <div class="error">
                    <?php
                    if (@$_GET['Empty'] == true) {
                        echo $_GET['Empty'];
                    }

                    if (@$_GET['Invalid'] == true) {
                        echo $_GET['Invalid'];
                    }
                    ?>
                </div>

                <div class="cont-form">
                    <input class="box-size" type="text" name="username" id="op_username" placeholder="Username">
                    <input class="box-size" type="password" name="password" id="op_password" placeholder="Password">
                    <label>
                        <input class="check-box" type="checkbox" onclick="myFunction()"> <!--  this checkbox is for show password -->
                        Show Password
                    </label>
                    <button class="login-btn" type="submit" name="login" id="login-button"> Login </button>

                </div>
            </form>
        </div>
    </div>
</body>


<script>
    function myFunction() {
        var x = document.getElementById("op_password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    // $(document).ready(function() {

    //     var header = $(".stacktop");
    //     $(window).scroll(function() {
    //         var scroll = $(window).scrollTop();

    //         if (scroll >= 100) {
    //             header.removeClass("stacktop").addClass("darkheader");
    //         } else {
    //             header.removeClass("darkheader").addClass("stacktop");
    //         }
    //     });
    // });
</script>


</html>