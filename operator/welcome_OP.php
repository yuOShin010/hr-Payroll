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
    <script src="http://kit.fontawesome.com/a076d05  399.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/blog.css">
    <title>Symtech Homepage</title>
</head>

<body>
    <header class="topbar blurheader" id="blur">
        <div class="logout-right ">
            <a href="logout_OP.php?logout" class="logout-right">Logout</a>
        </div>

        <ul class="topbar-items">
            <li><a href="#cont2" class="ul">IT Team</a></li>
            <li><a href="#cont3" class="ul">Developers</a></li>
            <li><a href="#cont4" class="ul">Stakeholders</a></li>
        </ul>
    </header>
    <!-- <h1 class="home-page-text">Symtech | Payroll Management System</h1>
        <div class="front"> 
            <button><a href="UI_addEmployee.php">Getting Started</a></h3></button>
        </div -->

    <div class="container ">
        <!-- <div class="f-content"> -->
        <div class="content">
            <div class="context">
                <?php

                if (isset($_SESSION['User'])) {
                    echo '<div class="welcome">' . '<h1>' . ' Welcome ' . $_SESSION['User'] . '</h1>' . '</div>';
                } else {
                    header("location:../index_OP.php");
                }

                ?>
                <p>A payroll system involves everything that has to do with the payment of employees and the filing of ­employment taxes.
                    This includes keeping track of hours, calculating wages, withholding taxes and other deductions, printing and delivering checks and paying employment taxes to the government.

                    The payroll system starts when a company hires its first employee. In the United States, every new employee must be reported to the state along with a completed W-4 tax form.
                    The W-4 determines how many allowances the employee qualifies for when calculating the federal income tax that should be withheld from each check.
                    Generally, the more dependents you have,
                    the less income tax you have to pay.
                </p>

                <div class="getting">
                    <h1><a href="UI_addEmployee.php">Getting Started</a></h1>
                </div>
            </div>
        </div>
        <!-- </div> -->
    </div>
    <div style="clear:both"></div>

    <div class="s-content" id="cont2">
        <h1 class="cont2-fh1 cont2-color">IT TEAM</h1>
    </div>
    <div style="clear:both"></div>

    <div class="t-content" id="cont3">
        <h1 class="cont2-fh1 cont2-color ">DEVELOPERS</h1>
    </div>
    <div style="clear:both"></div>

    <div class="fth-content" id="cont4">
        <h1 class="cont2-fh1 cont2-color">STAKEHOLDERS</h1>
    </div>


    <!-- end of container 1 -->
    <script>
        $(document).ready(function() {
            // Add smooth scrolling to all links
            $("a").on('click', function(event) {

                // Make sure this.hash has a value before overriding default behavior
                if (this.hash !== "") {
                    // Prevent default anchor click behavior
                    event.preventDefault();

                    // Store hash
                    var hash = this.hash;

                    // Using jQuery's animate() method to add smooth page scroll
                    // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 800, function() {

                        // Add hash (#) to URL when done scrolling (default click behavior)
                        window.location.hash = hash;
                    });
                } // End if
            });
            // //When Scrolling
            // var header = $(".topbar");
            // $(window).scroll(function() {
            //     var scroll = $(window).scrollTop();

            //     if (scroll >= 500) {
            //         header.addClass("blurheader").removeClass("topbar");
            //     } else {
            //         header.removeClass("topbar").addClass("blurheader");
            //     }
            // });
        });
    </script>
    <!-- <script>
            $(document).ready(function(){
                
                var header = $(".clearheader");
                $(window).scroll(function(){
                var scroll = $(window).scrollTop();

                    if(scroll >= 100) {
                        header.removeClass("clearheader").addClass("darkheader");
                    } else {
                        header.removeClass("darkheader").addClass("clearheader");
                    }
                });
            });  
        </script> -->
</body>

</html>