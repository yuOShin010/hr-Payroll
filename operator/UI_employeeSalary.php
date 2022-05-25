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
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/proper-placement.css">

    <title>Employee Salary</title>

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
            <div class="side-bar">
                    <h3>SymTech</h3>
                </div>
            <ul>
                <li>
                <a href="../operator/UI_addEmployee.php">
                    <i class='bx bxs-user-account'></i>
                    <p>Employee Management</p>
                </a>

            </li>
            <li>
                <a href="../operator/UI_setDepartment.php">
                    <i class='bx bxs-building-house'></i>
                    <p>Department Management</p>
                </a>
            </li>
            <li>
                <a href="../operator/UI_schedule.php">
                    <i class='bx bxs-calendar'></i>
                    <p>Scheduling Management</p>
                </a>
            </li>
            <li>
                <a href="../operator/UI_payroll.php">
                    <i class='bx bxs-data'></i>
                    <p>Payroll Management</p>
                </a>
            </li>
            <li>
                <a href="../operator/UI_employeeSalary.php">
                    <i class='bx bx-task'></i>
                    <p>Employee Salary Report</p>
                </a>
            </li>
            <li>
                <a href="../operator/UI_payslipReport.php">
                    <i class='bx bxs-report'></i>
                    <p>Payslip Report/Print</p>
                </a>
            </li>
            <li>
                <a href="../operator/UI_companyReport.php">
                    <i class='bx bx-line-chart-down'></i>
                    <p>Company Report</p>
                </a>
            </li>
            </ul>
           
        </div>
    <header class="tophead">
    <!-- <p>top head</p> -->
    </header>
        <?php 

            if(isset($_SESSION['User']))
            {
                echo '<h1>'. 'WELCOME TO PAYROLL Employee Salary Report' .'</h1>';
                echo '<a href="../logout.php?logout">Logout</a>';
            }
            else
            {
                header("location:../index.php");
            }

        ?>
        </header>

        <!-- END DASHBOARD -->

        
</body>
</html>