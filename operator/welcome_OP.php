`<?php
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
    <script src="http://kit.fontawesome.com/a076d05399.js"></script>    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>    
    <link rel="stylesheet" href="../css/blog.css">
    <title>Symtech Homepage</title>
</head>
 
<body>
    
        <!-- <h1 class="home-page-text">Symtech | Payroll Management System</h1>
        <div class="front"> 
            <button><a href="UI_addEmployee.php">Getting Started</a></h3></button>
        </div -->
        <div class="container ">
            <header class="topbar clearheader">
                <ul>
                    <li>IT Team</li>
                    <li>Developers</li>
                    <li>Stakeholders</li>
                </ul> 
            </header>
            <?php 

                    if(isset($_SESSION['User']))
                    {
                        echo '<div class="welcome">'.'<h1>'.' Welcome ' . $_SESSION['User'].'</h1>'.'</div>';
                        echo '<div class="welcome">'.'<h1>'.'<a href="logout_OP.php?logout">Logout</a>'.'<h1>'.'</div>' ;
                        
                        
                    }
                    else
                    {
                        header("location:../index_OP.php");
                    }

                ?>
            <div class="content">
               
                        
      
                    <div class="context">
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
        </div>
        <!-- end of container 1 -->
        
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
</html>`