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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/default.css">   
    <title>Payroll Management</title>


    <script>

        function show() {
            document.getElementById('navigation').classList.toggle('active');
        }   

</script>

</head>
<body>
    <!-- DASHBOARD -->

    <div id="navigation"> 
            
            <div class="toggle-btn" onclick="show()">
                <span></span>
                <span></span>
                <span></span>
            </div>
            
            <ul>
                <div class="side-bar">
                    <h3>SymTech</h3>
                </div>
                <li> <a href="../operator/UI_addEmployee.php">Employee Management</a></li>
                <li> <a href="../operator/UI_setDepartment.php">Department Management</a></li>
                <li> <a href="../operator/UI_schedule.php">Scheduling Management</a></li>
                <li> <a href="../operator/UI_payroll.php">Payroll Management</a></li>
                <li> <a href="../operator/UI_employeeSalary.php">Employee Salary Report</a></li>
                <li> <a href="../operator/UI_payslipReport.php">Payslip Report/Print</a></li>
                <li> <a href="../operator/UI_companyReport.php">Company Report</a></li>
            </ul>
           
        </div>
        <?php 

            if(isset($_SESSION['User']))
            {
                echo '<h1>'.'WELCOME TO PAYROLL MANAGEMENT'.'</h1>';
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