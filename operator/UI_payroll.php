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
    <link rel="stylesheet" href="../css/UI_payroll.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Payroll | Symtech</title>
</head>
<body>
    <!-- DASHBOARD -->

    <div class="admin-dashboard"> 
            <div class="home-sidebar">
                <img  class="home-logo" src="https://img.icons8.com/glyph-neue/2x/home-page.png" alt="logo">
            </div>
              <header class="top-bar">
                    <h1>SymTech | <p>HR payroll</p></h1>
              </header>
            <ul>
                <!-- <li> <a href="../operator/UI_dash_overview.php">Dashboard Overview</a></li> -->
                <li> <a href="../operator/UI_addEmployee.php">Employee Management</a></li>
                <li> <a href="../operator/UI_setDepartment.php">Department Management</a></li>
                <li> <a href="../operator/UI_schedule.php">Scheduling Management</a></li>
                <li> <a href="../operator/UI_payroll.php">Payroll Management</a></li>
                <li> <a href="#">Employee Salary Report</a></li>
                <li> <a href="#">Payslip Report/Print</a></li>
                <li> <a href="#">Company Report</a></li>
                <!--<li> <a href="#">Company Expenses</a></li> -->
            </ul>
            <hr>
            <footer>
                <p>No copy right</p>
            </footer>
        </div>
        <header class="secondtop-bar">
        <?php 

            if(isset($_SESSION['User']))
            {
                echo '<h1>'.' Welcome ' . $_SESSION['User'].'</h1>';
                echo '<a href="logout_OP.php?logout">Logout</a>';
            }
            else
            {
                header("location:../index_OP.php");
            }

        ?>
        </header>

        <!-- END DASHBOARD -->

        <h1> WELCOME TO PAYROLL MANAGEMENT</h1>
</body>
</html>