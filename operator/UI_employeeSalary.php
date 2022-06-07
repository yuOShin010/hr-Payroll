<?php
    session_start();
    require_once('../php/classes/payrollClass.php');
    require_once('../php/classes/salary_class.php');
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
    <script src="../sweet_alert/jquery-3.6.0.min.js"></script>
    <script src="../sweet_alert/sweetalert2.all.min.js"></script>
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
    <header class="tophead">
        <!-- <p>top head</p> -->
        <?php

        if (isset($_SESSION['User'])) {
            echo '<h1 class="greet">' . 'EMPLOYEE SALARY REPORT' . '</h1>';
            echo '<a href="../logout.php?logout"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 logout" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
          </svg></a>';
        } else {
            header("location:../index.php");
        }

        ?>
    </header>

    <div id="navigation"> 
        <div class="title">
            <h1 class="t-left">SymTech</h1>
            <h1 class="dot">.</h1>
        </div>
        <!-- <div class="toggle-btn" onclick="show()">
            <span></span>
            <span></span>
            <span></span>
        </div> -->
        <ul>
        <li>
            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="padding-left: 16px;float: left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="M3 5v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2H5c-1.103 0-2 .897-2 2zm16.001 14H5V5h14l.001 14z"></path><path d="M11 7h2v10h-2zm4 3h2v7h-2zm-8 2h2v5H7z"></path></svg>
                <p>Dashboard</p>
            </a>
        </li>
        <li>
            <a href="../operator/UI_addEmployee.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="padding-left: 16px; float:left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="M15 11h7v2h-7zm1 4h6v2h-6zm-2-8h8v2h-8zM4 19h10v-1c0-2.757-2.243-5-5-5H7c-2.757 0-5 2.243-5 5v1h2zm4-7c1.995 0 3.5-1.505 3.5-3.5S9.995 5 8 5 4.5 6.505 4.5 8.5 6.005 12 8 12z"></path></svg>
                <p>Employee Management</p>
            </a>

        </li>
        <li>
            <a href="../operator/UI_setDepartment.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="padding-left: 16px; float:left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="M7 14.001h2v2H7z"></path><path d="M19 2h-8a2 2 0 0 0-2 2v6H5c-1.103 0-2 .897-2 2v9a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2zM5 20v-8h6v8H5zm9-12h-2V6h2v2zm4 8h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V6h2v2z"></path></svg>
                <p>Department Management</p>
            </a>
        </li>
        <li>
            <a href="../operator/UI_schedule.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="padding-left: 16px; float:left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="M21 20V6c0-1.103-.897-2-2-2h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2zM9 18H7v-2h2v2zm0-4H7v-2h2v2zm4 4h-2v-2h2v2zm0-4h-2v-2h2v2zm4 4h-2v-2h2v2zm0-4h-2v-2h2v2zm2-5H5V7h14v2z"></path></svg>
                <p>Scheduling Management</p>
            </a>
        </li>
        <li>
            <a href="../operator/UI_payroll.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="padding-left: 16px; float:left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="M20 6c0-2.168-3.663-4-8-4S4 3.832 4 6v2c0 2.168 3.663 4 8 4s8-1.832 8-4V6zm-8 13c-4.337 0-8-1.832-8-4v3c0 2.168 3.663 4 8 4s8-1.832 8-4v-3c0 2.168-3.663 4-8 4z"></path><path d="M20 10c0 2.168-3.663 4-8 4s-8-1.832-8-4v3c0 2.168 3.663 4 8 4s8-1.832 8-4v-3z"></path></svg>
                <p>Payroll Management</p>
            </a>
        </li>
        <li>
            <a href="../operator/UI_employeeSalary.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="padding-left: 16px; float:left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="M20 3H4c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zM4 19V5h16l.002 14H4z"></path><path d="M6 7h12v2H6zm0 4h12v2H6zm0 4h6v2H6z"></path></svg>
                <p>Employee Salary Report</p>
            </a>
        </li>
        <li>
            <a href="../operator/UI_payslipReport.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="padding-left: 16px; float:left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="m12 16 4-5h-3V4h-2v7H8z"></path><path d="M20 18H4v-7H2v7c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2v-7h-2v7z"></path></svg>
                <p>Payslip Report/Print</p>
            </a>
        </li>
        <li>
            <a href="../operator/UI_companyReport.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="padding-left: 16px; float:left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="M5 3H3v18h18v-2H5z"></path><path d="M13 12.586 8.707 8.293 7.293 9.707 13 15.414l3-3 4.293 4.293 1.414-1.414L16 9.586z"></path></svg>
                <p>Company Report</p>
            </a>
        </li>
        </ul>
    </div>
    <!--_________________________________END OF TOPBAR___________________________________________-->
    <!--_________________________________END OF DASHBOARD__________________________________________-->

     <?php 
        $activeForm = true;

        if(isset($_POST['search']))    // This is the form active = false--
        {    
            $activeForm = false;
            $search_EID = $_POST['search_E_ID'];

            $sql = "SELECT
            A.id,
            B.employee_id, B.isActive, B.first_name, B.last_name, B.contact,
            C.dept_id, C.dept_code,
            D.position_desc,
            E.total_workHrs, E.d_from, E.d_to, E.days_works,
            F.overtime, F.allowance, F.holidays_work, F.leave_days, F.sss, F.tax, F.pag_ibig, F.phil_health,
            F.sss_loan, F.tax_loan, F.pag_ibig_loan, F.phil_health_loan, F.others, F.total_deduction,
            G.hours_pay, G.ot_pay, G.holidays_pay, G.leave_days_pay, G.allowance_pay, G.basic_pay, G.net_pay
            FROM tbl_employee_salary AS A
            LEFT JOIN employee AS B
            ON A.employee_id = B.employee_id
            LEFT JOIN department AS C
            ON A.dept_id = C.dept_id
            LEFT JOIN position AS D
            ON A.position_id = D.position_id
            LEFT JOIN schedule AS E
            ON A.employee_id = E.employee_id
            LEFT JOIN payroll AS F
            ON A.employee_id = F.employee_id
            LEFT JOIN salary_report AS G
            ON A.employee_id = G.employee_id
            WHERE B.employee_id = ? AND B.isActive = 1 AND A.id > 0";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([$search_EID]);

            if($stmt->rowCount() > 0)
            {

                // call update class salary
                $salary_class->active_update_salary();

                while($row = $stmt->fetch()){
                    $E_ID = $row['employee_id'];
                    $fname = $row['first_name'];
                    $lname = $row['last_name'];
                    $contact = $row['contact'];
                    $dept_id = $row['dept_id'];
                    $dept_code = $row['dept_code'];
                    // $position_id = $row['position_id'];
                    $position_desc = $row['position_desc'];
                    $total_workHrs = $row['total_workHrs'];
                    $d_from = $row['d_from'];
                    $d_to = $row['d_to'];
                    $days_works = $row['days_works'];
                    // for update credential
                    $overtime = $row['overtime'];
                    $allowance = $row['allowance'];
                    $holidays_work = $row['holidays_work'];
                    $leave_days = $row['leave_days'];
                    // Deductions Below
                    $total_deduction = $row['total_deduction'];
                    // pay
                    $days_work_pay = $row['days_work_pay'];
                    $hours_pay = $row['hours_pay'];
                    $ot_pay = $row['ot_pay'];
                    $holidays_pay = $row['holidays_pay'];
                    $leave_days_pay = $row['leave_days_pay'];
                    $allowance_pay = $row['allowance_pay'];
                    $basic_pay = $row['basic_pay'];
                    $net_pay = $row['net_pay'];
                    
                }

            } elseif (isset($_POST['search'])) {
                $search_EID = $_POST['search_E_ID'];

                $sql = "SELECT
                A.id,
                B.employee_id, B.isActive, B.first_name, B.last_name, B.email, B.contact,
                C.dept_id, C.dept_code,
                D.position_desc,
                E.total_workHrs, E.d_from, E.d_to, E.days_works,
                F.overtime, F.allowance, F.holidays_work, F.leave_days, F.sss, F.tax, F.pag_ibig, F.phil_health,
                F.sss_loan, F.tax_loan, F.pag_ibig_loan, F.phil_health_loan, F.others, F.total_deduction
                FROM tbl_employee_payroll AS A
                LEFT JOIN employee AS B
                ON A.employee_id = B.employee_id
                LEFT JOIN department AS C
                ON A.dept_id = C.dept_id
                LEFT JOIN position AS D
                ON A.position_id = D.position_id
                LEFT JOIN schedule AS E
                ON A.employee_id = E.employee_id
                LEFT JOIN payroll AS F
                ON A.employee_id = F.employee_id
                WHERE B.employee_id = ? AND B.isActive = 1 AND A.id > 0";

                $stmt = $pdo->prepare($sql);
                $stmt->execute([$search_EID]);

                if($stmt->rowCount() > 0){
    
                    // call Save class salary
                    $salary_class->active_save_salary();
    
                    while($row = $stmt->fetch()){

                        $E_ID = $row['employee_id'];
                        $fname = $row['first_name'];
                        $lname = $row['last_name'];
                        $contact = $row['contact'];
                        $dept_id = $row['dept_id'];
                        $dept_code = $row['dept_code'];
                        // $position_id = $row['position_id'];
                        $position_desc = $row['position_desc'];
                        $total_workHrs = $row['total_workHrs'];
                        $d_from = $row['d_from'];
                        $d_to = $row['d_to'];
                        $days_works = $row['days_works'];
                        // for update credential
                        $overtime = $row['overtime'];
                        $allowance = $row['allowance'];
                        $holidays_work = $row['holidays_work'];
                        $leave_days = $row['leave_days'];
                        // Deductions Below
                        $total_deduction = $row['total_deduction'];
                        
                    }
                } elseif (isset($_POST['search'])) {

                    $search_EID = $_POST['search_E_ID'];

                    $sql = "SELECT
                    A.id,
                    B.employee_id, B.isActive, B.first_name, B.last_name, B.email, B.contact,
                    C.dept_id, C.dept_code,
                    D.position_id, D.position_desc,
                    E.total_workHrs, E.d_from, E.d_to, E.days_works
                    FROM tbl_employee_schedule AS A
                    LEFT JOIN employee AS B
                    ON A.employee_id = B.employee_id
                    LEFT JOIN department AS C
                    ON A.dept_id = C.dept_id
                    LEFT JOIN position AS D
                    ON A.position_id = D.position_id
                    LEFT JOIN schedule AS E
                    ON A.employee_id = E.employee_id
                    WHERE B.employee_id = ? AND B.isActive = 1 AND A.id > 0";

                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$search_EID]);

                    if ($stmt->rowCount() > 0) {
                        
                        echo    "<script>";
                        echo    "Swal.fire({
                                    icon: 'info',
                                    title: 'Incomplete',
                                    text: 'No payroll data inserted',
                                }).then((result) => {
                                    if(result) {
                                        window.location.href='../operator/UI_employeeSalary.php';
                                    }
                                })";
                        echo    "</script>";

                    } elseif (isset($_POST['search'])) {
                        $search_EID = $_POST['search_E_ID'];
                        
                        $sql = "SELECT
                        A.id,
                        B.employee_id, B.isActive, B.first_name, B.last_name, B.email, B.contact, 
                        C.position_id, C.position_desc,
                        D.dept_id, D.dept_code
                        FROM tbl_employee_department_position AS A
                        LEFT JOIN employee AS B
                        ON A.employee_id = B.employee_id
                        LEFT JOIN position AS C
                        ON A.position_id = C.position_id
                        LEFT JOIN department AS D
                        ON A.dept_id = D.dept_id
                        WHERE B.employee_id = ? AND B.isActive = 1 AND A.id > 0";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([$search_EID]);

                        if($stmt->rowCount() > 0){

                            echo    "<script>";
                            echo    "Swal.fire({
                                        icon: 'info',
                                        title: 'Incomplete',
                                        text: 'No schedule and payroll inserted',
                                    }).then((result) => {
                                        if(result) {
                                            window.location.href='../operator/UI_employeeSalary.php';
                                        }
                                    })";
                            echo    "</script>";

                        } elseif (isset($_POST['search'])) {
                            $search_EID = $_POST["search_E_ID"];
                            $sql = "SELECT * FROM `employee` WHERE employee_id = ? AND isActive = 1";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute([$search_EID]);

                            if($stmt->rowCount() > 0){

                                echo    "<script>";
                                echo    "Swal.fire({
                                            icon: 'info',
                                            title: 'Incomplete',
                                            text: 'Department, schedule and payroll has no data inserted',
                                        }).then((result) => {
                                            if(result) {
                                                window.location.href='../operator/UI_employeeSalary.php';
                                            }
                                        })";
                                echo    "</script>";

                            } else {
                                echo    "<script>";
                                echo    "Swal.fire({
                                            icon: 'warning',
                                            title: 'No Employee Found',
                                        }).then((result) => {
                                            if(result) {
                                                window.location.href='../operator/UI_employeeSalary.php';
                                            }
                                        })";
                                echo    "</script>"; 
                            }
                        }
                    }
                }
            }
        }

    if($activeForm){

        ?>
        <div class="banner">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 back-btn" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
            <path strokeLinecap="round" strokeLinejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        </div>

        <div class="container-large">
            <form action="UI_employeeSalary.php" method="post">
                <!-- form search-->
                <div class="search-bg">
                    <div class="search">
                        <input class="input-style search-style" placeholder="Search Employee ID" type="number" name="search_E_ID" id="search_E_ID">
                        <button type="submit" name="search" id="search_e"><i class='bx bx-search bx-margin'></i></button>
                    </div>
                </div>
            </form>

                <label>
                    <input class="input-style inpt-pl20" type="number" name="" id="" required readonly> 
                    <p>Employee ID</p>
                </label>
                <label>
                    <input class="input-style inpt-pl20" type="text" name="fname" id="fname" required readonly>
                    <p>First Name</p>
                </label>
                <label>
                    <input class="input-style inpt-pl20" type="text" name="lname" id="lname" required readonly>
                    <p>Last Name</p>
                </label>
                <label>
                    <input class="input-style inpt-pl20 removearrow" type="number" name="contact" id="contact" required readonly>
                    <p>Contact</p>
                </label>
                
                <label>
                    <input class="input-style inpt-pl20 removearrow" type="number" name="hours_work" id="hours_work" required readonly>
                    <p>Employee Department</p>
                </label>
                <label>
                    <input class="input-style inpt-pl20 removearrow" type="number" name="hours_work" id="hours_work" required readonly>
                    <p>Position</p>
                </label>
                <br>

                <label>
                    <input class="input-style inpt-pl20" type="number" name="days_work" id="days_work" required readonly>
                    <p>Overtime</p>
                </label>
                <label>
                    <input class="input-style inpt-pl20" type="number" name="days_work" id="days_work" required readonly>
                    <p>Holidays Works</p>
                </label>
                <label>
                    <input class="input-style inpt-pl20" type="number" name="days_work" id="days_work" required readonly>
                    <p>Allowance</p>
                </label>
                <label>
                    <input class="input-style inpt-pl20" type="number" name="days_work" id="days_work" required readonly>
                    <p>Work Hours</p>
                </label>
                <label>
                    <input class="input-style inpt-pl20" type="number" name="days_work" id="days_work" required readonly>
                    <p>Days Work</p>
                </label>
                <label>
                    <input class="input-style inpt-pl20" type="number" name="days_work" id="days_work" required readonly>
                    <p>Leave Days</p>
                </label>
                <br>
                <h3>Start Here ..</h3>
                <!-- Pay -->
                <!-- <label>
                    <input class="input-style inpt-pl20" type="number" name="days_work" id="days_work" required readonly>
                    <p>Days Work Pay</p>
                </label> -->
                <label>
                    <input class="input-style inpt-pl20" type="number" name="days_work" id="days_work" required readonly>
                    <p>Total Hours Pay</p>
                </label>
                <label>
                    <input class="input-style inpt-pl20" type="number" name="days_work" id="days_work" required readonly>
                    <p>Over Time Pay</p>
                </label>
                <label>
                    <input class="input-style inpt-pl20" type="number" name="days_work" id="days_work" required readonly>
                    <p>Holidays Pay</p>
                </label>
                <label>
                    <input class="input-style inpt-pl20" type="number" name="days_work" id="days_work" required readonly>
                    <p>Leave Days Pay</p>
                </label>
                <label>
                    <input class="input-style inpt-pl20" type="number" name="days_work" id="days_work" required readonly>
                    <p>Allowance Pay</p>
                </label>
                <label>
                    <input class="input-style inpt-pl20" type="number" name="days_work" id="days_work" required readonly>
                    <p>Basic Pay</p>
                </label>
                <br><br>
                
                <label>
                    <input value="Regular" type="button"  name="" id="" required>
                </label>
                <label>
                    <input value="Contractual" type="button" name="" id="" required>
                </label>
                <br><br>
                    <label>
                        <input class="int-red" type="number" name="" id="" required>
                        <p>Deduction Total</p>
                    </label>
                    <label>
                        <input class="int-green" type="number" name="" id="" required>
                        <p>NetPay</p>
                    </label>
                    <button class="button" disabled>Save</button>
                    <button class="button" disabled>Update</button>
                    <!-- <button class="button" disabled>Delete</button> -->
        </div>



<<<<<<< HEAD
        <section class="banner"><h2>Database Table</h2></section> <!--this is the banner -->
    <!-- ________________________________DATABASE TABLE_______________________________ -->
                        <div class="output">
=======
        <section class="banner2"><h2>Database Table</h2></section> <!--this is the banner -->
        <!-- ________________________________DATABASE TABLE_______________________________ -->
                <div class="output">
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>E_ID</th>
                                <th>First_Name</th>
                                <th>Last_Name</th>
                                <th>Contact</th>
                                <th>Dept</th>
                                <th>Position</th>
                                <!-- <th>Days_work Pay</th> -->
                                <th>Total_wrkHrs Pay</th>
                                <th>O.T Pay</th>
                                <th>Hlldy_wrk Pay</th>
                                <th>Leave Pay</th>
                                <th>Allwnce_Pay</th>
                                <th>Basic_Pay</th>
                                <th>Deductions</th>
                                <th>Net_Pay</th>
                            </tr>
                        </thead>
>>>>>>> 23012652b0f92748d664cf7ad9eb24087537bc29

                        <tbody>
                            <?php
                            $pdo = $classPayroll->openConnection();
                            $sql = "SELECT
                            A.id,
                            B.employee_id, B.isActive, B.first_name, B.last_name, B.contact,
                            C.dept_id, C.dept_code,
                            D.position_desc,
                            E.total_workHrs, E.d_from, E.d_to, E.days_works,
                            F.overtime, F.allowance, F.holidays_work, F.leave_days, F.sss, F.tax, F.pag_ibig, F.phil_health,
                            F.sss_loan, F.tax_loan, F.pag_ibig_loan, F.phil_health_loan, F.others, F.total_deduction,
                            G.hours_pay, G.ot_pay, G.holidays_pay, G.leave_days_pay, G.allowance_pay, G.basic_pay, G.net_pay
                            FROM tbl_employee_salary AS A
                            LEFT JOIN employee AS B
                            ON A.employee_id = B.employee_id
                            LEFT JOIN department AS C
                            ON A.dept_id = C.dept_id
                            LEFT JOIN position AS D
                            ON A.position_id = D.position_id
                            LEFT JOIN schedule AS E
                            ON A.employee_id = E.employee_id
                            LEFT JOIN payroll AS F
                            ON A.employee_id = F.employee_id
                            LEFT JOIN salary_report AS G
                            ON A.employee_id = G.employee_id
                            WHERE B.isActive = 1 AND A.id > 0";

                            $stmt = $pdo->prepare($sql);
                            $stmt->execute();


                            if ($stmt->rowCount() > 0) {
                                foreach ($stmt as $row) {
                            ?>
                                <tr>
                                    <td><?php echo $row['employee_id']; ?></td>
                                    <td><?php echo $row['first_name']; ?></td>
                                    <td><?php echo $row['last_name']; ?></td>
                                    <td><?php echo $row['contact']; ?></td>
                                    <td><?php echo $row['dept_code']; ?></td>
                                    <td><?php echo $row['position_desc']; ?></td>
                                    <td><?php echo $row['hours_pay']; ?></td>
                                    <td><?php echo $row['ot_pay']; ?></td>
                                    <td><?php echo $row['holidays_pay']; ?></td>
                                    <td><?php echo $row['leave_days_pay']; ?></td>
                                    <td><?php echo $row['allowance_pay']; ?></td>
                                    <td><?php echo $row['basic_pay']; ?></td>
                                    <td><?php echo $row['total_deduction']; ?></td>
                                    <td><?php echo $row['net_pay']; ?></td>
                                </tr>
                            <?php }} ?>
                        </tbody>
                    </table>
                </div>

        <?php
    }



?> 
</body>
</html>