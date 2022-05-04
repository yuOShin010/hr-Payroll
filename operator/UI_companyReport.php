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
    <link rel="stylesheet" href="../css/UI_companyReport.css">
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
                <li> <a href="../operator/UI_addEmployee.php">Employee Management</a></li>
                <li> <a href="../operator/UI_setDepartment.php">Department Management</a></li>
                <li> <a href="../operator/UI_schedule.php">Scheduling Management</a></li>
                <li> <a href="../operator/UI_payroll.php">Payroll Management</a></li>
                <li> <a href="../operator/UI_employeeSalary.php">Employee Salary Report</a></li>
                <li> <a href="../operator/UI_payslipReport.php">Payslip Report/Print</a></li>
                <li> <a href="../operator/UI_companyReport.php">Company Report</a></li>
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
                echo '<h1>'.'Welcome to Company Report'.'</h1>';
                echo '<a href="logout_OP.php?logout">Logout</a>';
            }
            else
            {
                header("location:../index_OP.php");
            }

        ?>
        </header>

        <!-- END DASHBOARD -->

</body>
</html>