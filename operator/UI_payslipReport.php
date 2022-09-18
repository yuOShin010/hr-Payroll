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

    <title>Payslip Report</title>

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
            echo '<h1 class="greet">' . 'PAYSLIP REPORT' . '</h1>';
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

        if(isset($_POST['search'])){
            $activeForm = false;

            $search_EID = $_POST['search_E_ID'];
            $sql = "SELECT
            A.id,
            B.employee_id, B.isActive, B.first_name, B.last_name, B.contact, B.stats, B.email,
            C.dept_id, C.dept_code,
            D.position_id, D.position_desc,
            E.total_workHrs, E.d_from, E.d_to, E.days_works,
            F.overtime, F.allowance, F.holidays_work, F.leave_days, 
            G.hours_pay, G.ot_pay, G.holidays_pay, G.leave_days_pay, G.allowance_pay,
            G.sss, G.tax, G.pag_ibig, G.phil_health, G.others, G.total_deductions, G.gross_pay, G.net_pay
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
                // $salary_class->active_update_salary();

                while($row = $stmt->fetch()){
                    $E_ID = $row['employee_id'];
                    $fname = $row['first_name'];
                    $lname = $row['last_name'];
                    $contact = $row['contact'];
                    $email = $row['email'];
                    $stats = $row['stats'];
                    $dept_id = $row['dept_id'];
                    $dept_code = $row['dept_code'];
                    $position_id = $row['position_id'];
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
                    $total_deduction = $row['total_deductions'];
                    // pay
                    // $days_work_pay = $row['days_work_pay'];
                    $hours_pay = $row['hours_pay'];
                    $ot_pay = $row['ot_pay'];
                    $holidays_pay = $row['holidays_pay'];
                    $leave_days_pay = $row['leave_days_pay'];
                    $allowance_pay = $row['allowance_pay'];
                    $sss = $row['sss'];
                    $tax = $row['tax'];
                    $pagibig = $row['pag_ibig'];
                    $philhealth = $row['phil_health'];
                    $others = $row['others'];
                    
                    $gross_pay = $row['gross_pay'];
                    $net_pay = $row['net_pay'];
                    
                } ?>

                        <div class="banner">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 back-btn" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                                <path strokeLinecap="round" strokeLinejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                        </div>

                        <div class="container-xlarge">
                            <form action="UI_payslipReport.php" method="post">
                                <!-- form search-->
                                <div class="search-bg">
                                    <div class="search">
                                        <input class="input-style search-style" placeholder="Search Employee ID" type="number" name="search_E_ID" id="search_E_ID">
                                        <button type="submit" name="search" id="search_e"><i class='bx bx-search bx-margin'></i></button>
                                    </div>
                                </div>
                            </form>

                            <form action="../generating_pdf.php" method="post">
                                <h3>Basic Information:</h3>
                                <label>
                                    <input class="input-style inpt-pl20" type="number" name="employee_id" id="" required readonly value="<?php echo $E_ID; ?>"> 
                                    <p>Employee ID</p>
                                </label>
                                <label>
                                    <input class="input-style inpt-pl20" type="text" name="fname" id="fname" required readonly value="<?php echo $fname; ?>">
                                    <p>First Name</p>
                                </label>
                                <label>
                                    <input class="input-style inpt-pl20" type="text" name="lname" id="lname" required readonly value="<?php echo $lname; ?>">
                                    <p>Last Name</p>
                                </label>
                                <label>
                                    <input class="input-style inpt-pl20 removearrow" type="number" name="contact" id="contact" required readonly value="<?php echo $contact; ?>">
                                    <p>Contact</p>
                                </label>
                                <label>
                                    <input class="input-style inpt-pl20 removearrow" type="email" name="email" id="email" required readonly value="<?php echo $email; ?>">
                                    <p>Email</p>
                                </label>
                                <label>
                                    <input class="input-style inpt-pl20 removearrow" type="text" name="dept_code" id="dept_code" required readonly value="<?php echo $dept_code; ?>">
                                    <p>Department</p>
                                </label>
                                <label>
                                    <input class="input-style inpt-pl20 removearrow" type="text" name="position_desc" id="position_desc" required readonly value="<?php echo $position_desc; ?>">
                                    <p>Position</p>
                                </label>
                                <label>
                                    <input class="input-style inpt-pl20 removearrow" type="text" name="stats" id="email" required readonly value="<?php echo $stats; ?>">
                                    <p>Status</p>
                                </label>
                                <!-- <label>
                                    <select class="option-size" name="dept_id" id="dept_id" required>
                                        <option selected hidden  value="<?php echo $dept_id; ?>"> <?php echo $dept_code; ?> </option>
                                    </select>
                                    <p>Department</p>
                                </label>
                                <label class="options-right">
                                    <select class="option-size" name="position" id="position_id" required>
                                        <option selected hidden value="<?php echo $position_id; ?>"> <?php echo $position_desc; ?> </option>
                                    </select>
                                    <p>Position</p>
                                </label> 
                                <label class="options-right">
                                    <select class="option-size" name="status" id="status" required>
                                        <option selected hidden value="<?php echo $stats; ?>"> <?php echo $stats; ?> </option>
                                    </select>
                                    <p>Status</p>
                                </label>  -->
                                <label>
                                    <input class="input-style inpt-pl20 removearrow" type="date" name="d_from" id="d_from" required readonly value="<?php echo $d_from; ?>">
                                    <p>Date From</p>
                                </label>
                                <label>
                                    <input class="input-style inpt-pl20 removearrow" type="date" name="d_to" id="d_to" required readonly value="<?php echo $d_to; ?>">
                                    <p>Date To</p>
                                </label>
                                <label>
                                    <input class="input-style inpt-pl20 removearrow" type="number" name="days_works" id="days_works" required readonly value="<?php echo $days_works; ?>">
                                    <p>Total Work Days</p>
                                </label>
                                <label>
                                    <input class="input-style inpt-pl20 removearrow" type="number" name="hours_work" id="hours_work" required readonly value="<?php echo $total_workHrs; ?>">
                                    <p>Total Work hours</p>
                                </label>
                                <label>
                                    <input class="input-style inpt-pl20 removearrow" type="number" name="overtime" id="overtime" required readonly value="<?php echo $overtime; ?>">
                                    <p>Overtime</p>
                                </label>
                                <label>
                                    <input class="input-style inpt-pl20 removearrow" type="number" name="holidays" id="holidays" required readonly value="<?php echo $holidays_work; ?>">
                                    <p>Holidays Work</p>
                                </label>
                                <label>
                                    <input class="input-style inpt-pl20 removearrow" type="number" name="leave" id="leave" required readonly value="<?php echo $leave_days; ?>">
                                    <p>Leave Days</p>
                                </label>

                                <br>
                                <br>
                                <br> 
                                <!-- Pay -->
                                <h3>Pay Information:</h3>
                                <label>
                                    <input class="input-style inpt-pl20" type="number" name="hours_pay" id="hours_pay" step="any" required readonly value="<?php echo $hours_pay; ?>">
                                    <p>Total Hours Pay</p>
                                </label>
                                <label>
                                    <input class="input-style inpt-pl20" type="number" name="ot_pay" id="ot_pay" step="any" required readonly value="<?php echo $ot_pay; ?>">
                                    <p>Over Time Pay</p>
                                </label>
                                <label>
                                    <input class="input-style inpt-pl20" type="number" name="holiday_pay" id="holiday_pay" step="any" required readonly value="<?php echo $holidays_pay; ?>">
                                    <p>Holidays Work Pay</p>
                                </label>
                                <label>
                                    <input class="input-style inpt-pl20" type="number" name="leave_pay" id="leave_pay" step="any" required readonly value="<?php echo $leave_days_pay; ?>">
                                    <p>Leave Days Pay</p>
                                </label>
                                <label>
                                    <input class="input-style inpt-pl20" type="number" name="allowance_pay" id="allowance_pay" step="any" required readonly value="<?php echo $allowance_pay; ?>">
                                    <p>Allowance Pay</p>
                                </label>

                                <label>
                                    <input class="b-size" type="number" name="sss" id="sss" step="any" required placeholder="0" value="<?php echo $sss; ?>">
                                    <p>SSS</p>
                                </label>
                                <label>
                                    <input class="b-size" type="number" name="tax" id="tax" step="any" required placeholder="0" value="<?php echo $tax; ?>">
                                    <p>TAX</p>
                                </label>
                                <label>
                                    <input class="b-size" type="number" name="pagibig" id="pagibig" step="any" required placeholder="0" value="<?php echo $pagibig; ?>">
                                    <p>Pag-ibig</p>
                                </label>
                                <label>
                                    <input class="b-size" type="number" name="philhealth" id="philhealth" step="any" required placeholder="0" value="<?php echo $philhealth; ?>">
                                    <p>Phil-Health</p>
                                </label>
                                <label>
                                    <input class="b-size" type="number" name="others" id="others" step="any" required value="<?php echo $others; ?>">
                                    <p>Others</p>
                                </label>
                                
                                <label>
                                    <input class="b-size" type="number" name="gross_pay" id="gross_pay" step="any" required readonly value="<?php echo $gross_pay; ?>">
                                    <p>Gross Pay</p>
                                </label> 
                                <br>
                                <label>
                                    <input class="int-red" type="number" name="t_deduction" id="t_deduction" step="any" required value="<?php echo $total_deduction; ?>">
                                    <p>Total Deduction</p>
                                </label>
                                    <label>
                                        <input class="int-green" type="number" name="netpay" id="netpay" step="any" required value="<?php echo $net_pay; ?>">
                                        <p>NetPay</p>
                                    </label>
                                    <!-- <button class="button save">Save</button>
                                    <button class="button update">Update</button> -->
                                    <button class="button save">Print</button>
                            </form>    
                                    
                                </div> <?php


            }



        }
  

            if($activeForm){ ?>
                <div class="banner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 back-btn" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                        <path strokeLinecap="round" strokeLinejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </div>
                    <div class="container-xlarge">
                        <form action="UI_payslipReport.php" method="post">
                            <!-- form search-->
                            <div class="search-bg">
                                <div class="search">
                                    <input class="input-style search-style" placeholder="Search Employee ID" type="number" name="search_E_ID" id="search_E_ID">
                                    <button type="submit" name="search" id="search_e"><i class='bx bx-search bx-margin'></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php
            } ?>
        



        <!-- <section class="banner"><h2>Database Table</h2></section> this is the banner -->
    <!-- ________________________________DATABASE TABLE_______________________________ -->
                        <!-- <div class="output"> -->

                        <!-- </div> -->
      
</body>
</html>