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
        <link rel="stylesheet" href="../css/proper-placement.css">
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
            <?php

            if (isset($_SESSION['User'])) {
                echo '<h1>' . 'WELCOME TO PAYROLL MANAGEMENT' . '</h1>';
                echo '<a href="../logout.php?logout">Logout</a>';
            } else {
                header("location:../index.php");
            }

            ?>
        </header>
        <!------------------------------------------ END DASHBOARD ---------------------------------------->
        <?php $activeForm = true;

        if(isset($_POST['search']))    // This is the form active = false--
        {    
            $activeform = false;
            $setPayroll = true;
            $search_EID = $_POST['search_E_ID'];

            $sql = "SELECT
            A.id,
            B.employee_id, B.isActive, B.first_name, B.last_name, B.email B.contact,
            C.dept_id, C.dept_code,
            D.position_id, D.position_desc,
            E.total_workHrs, E.d_from, E.d_to, E.days_works
            F.overtime, F.allowance, F.holidays_work, F.leave_days, F.sss, F.tax, F.pag_ibig, F.phil_health,
            F.sss_loan, F.tax_loan, F.pag_ibig_loan, F.phil_health_loan, F.ohters F.total_deduction
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

            // echo "Success Search";

            if($stmt->rowCount() > 0)
            {
                while($row = $stmt->fetch()){
                    $E_ID = $row['employee_id'];
                    $fname = $row['first_name'];
                    $lname = $row['last_name'];
                    $email = $row['email'];
                    $contact = $row['contact'];
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
                    $holiday_work = $row['holiday_work'];
                    $leave_days = $row['leave_days'];
                    // Deductions Below
                    $sss = $row['sss'];
                    $tax = $row['tax'];
                    $pag_ibig = $row['pag_ibig'];
                    $phil_health = $row['phil_health'];
                    $sss_loan = $row['sss_loan'];
                    $tax_loan = $row['tax_loan'];
                    $pag_ibig_loan = $row['pag_ibig_loan'];
                    $phil_health_loan = $row['phil_health_loan'];
                    $ohters = $row['ohters'];
                    $total_deduction = $row['total_deduction'];
                }

            } elseif (isset($_POST['search']))      // SET SCHEDULE SAVE ACTIVE OPTION -----

            {          
                $setPayroll = false;
                $search_Eid = $_POST['search_E_ID'];

                $sql = "SELECT * FROM employee WHERE employee_id = ? AND isActive = 1";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$search_Eid]);
            
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
                $stmt->execute([$search_Eid]);

                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch()) {

                        $E_ID = $row['employee_id'];
                        $fname = $row['first_name'];
                        $lname = $row['last_name'];
                        $email = $row['email'];
                        $contact = $row['contact'];
                        // For Updating data Below Credentials    
                        $dept_id = $row['dept_id'];
                        $dept_code = $row['dept_code'];
                        $position_id = $row['position_id'];
                        $position_desc = $row['position_desc'];
                    }

                } elseif ($stmt->rowCount() <= 0) {
                    echo ("<script LANGUAGE='JavaScript'> window.alert('Please Set Department first Before Setting Shedule ....');
                    window.location.href='../operator/UI_schedule.php'; </script>");

                } else {
                    echo ("<script LANGUAGE='JavaScript'> window.alert('No employee Found ....');
                    window.location.href='../operator/UI_schedule.php'; </script>");
                }

                        // Active Save Here Codes generate

            } 
                
                if($setPayroll){ ?>
            
                        <!-- // Active Update Here Codes generate  -->

                    <div class="container container-style">
                        <form action="UI_payroll.php" method="post">
                            <!-- form search-->
                            <div class="search-bg">
                                <div class="search">
                                    <input class="input-style search-style" placeholder="Search Employee ID" type="number" name="search_E_ID" id="search_E_ID">
                                    <button type="submit" name="search" id="search"><i class='bx bx-search bx-margin'></i></button>
                                </div>
                            </div>
                        </form>

                        <!-- form -->
                        <form>
                        
                            <label>
                                <input class="input-style" type="text" name="fname" id="fname" required readonly value="<?php echo $E_ID ?>">
                                <p>E_ID</p>
                            </label>
                            <label>
                                <input class="input-style" type="text" name="fname" id="fname" required readonly value="<?php echo $fname ?>">
                                <p>First Name</p>
                            </label>
                            <label>
                                <input class="input-style" type="text" name="lname" id="lname" required readonly value="<?php echo $lname ?>">
                                <p>Last Name</p>
                            </label>
                            <!-- <label>
                                <input class="input-style" type="email" name="email" id="email" required readonly value="<?php echo $email ?>">
                                <p>Email</p>
                            </label> -->
                            <label>
                                <input class="input-style removearrow" type="number" name="contact" id="contact" required readonly value="<?php echo $contact ?>">
                                <p>Contact</p>
                            </label>
                            <label>
                                <select name="dept_id" id="dept_id" required>
                                    <option selected hidden value="<?php echo $dept_id ?>"><?php echo $dept_code ?></option>
                                </select>
                                <p>Employee Department</p>
                            </label>
                            <label>
                                <input class="input-style removearrow" type="number" name="hours_work" id="hours_work" required readonly value="<?php echo $total_workHrs ?>">
                                <p>Hours Work</p>
                            </label>
                            <label>
                                <input class="input-style removearrow" type="date" name="hours_work" id="hours_work" required readonly value="<?php echo $d_from ?>">
                                <p>Date From</p>
                            </label>
                            <label>
                                <input class="input-style removearrow" type="date" name="hours_work" id="hours_work" required readonly value="<?php echo $d_to ?>">
                                <p>Date To</p>
                            </label>
                            <label>
                                <input class="input-style" type="number" name="days_work" id="days_work" required readonly value="<?php echo $days_works ?>">
                                <p>Days Work</p>
                            </label>
                            <br>
                            <br>

                            <label class="b1">Over Time
                                <input class="b-size" type="number" name="" id="" required placeholder="0" value="<?php echo $overtime ?>">
                            </label>
                            <label class="b2">Allowance
                                <input class="b-size" type="number" name="" id="" required placeholder="0" value="<?php echo $allowance ?>">
                            </label>
                            <label class="b3">Holidays Work
                                <input class="b-size" type="number" name="" id="" required placeholder="0" value="<?php echo $holiday_work ?>">
                            </label>
                            <label class="b4">Leave Days
                                <input class="b-size" type="number" name="" id="" required placeholder="0" value="<?php echo $leave_days ?>">
                            </label>
                            <label class="b5">SSS
                                <input class="b-size" type="number" name="" id="" required placeholder="0" value="<?php echo $sss ?>">
                            </label>
                            <label class="b6">Pag-ibig
                                <input class="b-size" type="number" name="" id="" required placeholder="0" value="<?php echo $pag_ibig ?>">
                            </label>
                            <label class="b7">Phil-Health
                                <input class="b-size" type="number" name="" id="" required placeholder="0" value="<?php echo $phil_health ?>">
                            </label>
                            <label class="b8">SSS-Loan
                                <input class="b-size" type="number" name="" id="" required placeholder="0" value="<?php echo $sss_loan ?>">
                            </label>
                            <label class="b9">Pag-ibig loan
                                <input class="b-size" type="number" name="" id="" required placeholder="0" value="<?php echo $pag_ibig_loan ?>">
                            </label>
                            <label class="b10">Phil-Health Loan
                                <input class="b-size" type="number" name="" id="" required placeholder="0" value="<?php echo $phil_health_loan ?>">
                            </label>
                            <label class="b11">Others
                                <input class="b11-size" type="Text" name="" id="" required placeholder="0" value="<?php echo $ohters ?>">
                            </label>
                            <label class="b12">Deduction Total
                                <input class="b12-size" type="number" name="" id="" required value="<?php echo $total_deduction ?>">
                            </label>

                            <button class="button" disabled">Save</button>
                            <button class="button" type="submit" name="updatePayroll">Update</button>
                            <button class="button" disabled>Delete</button>

                        </form>

                        <!------------------------------------------ TABLE BELOW IS FOR SHOWING DATA FROM DATABASE ---------------------------------------->
                        <div class="output">
                            <table class="table table-dark table-striped">
                                <thead>
                                    <tr>
                                        <th>Employee ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <!-- <th>Email</th> -->
                                        <th>Contact</th>
                                        <th>Emp Dept</th>
                                        <th>Hrs_Wrks</th>
                                        <th>D_Frm</th>
                                        <th>D_To</th>
                                        <th>Total_wrkHrs</th>
                                        <th>O.T</th>
                                        <th>Allwnce</th>
                                        <th>Hlldy_wrk</th>
                                        <th>Lv.Dy</th>
                                        <th>Deductions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $pdo = $classPayroll->openConnection();
                                    $sql = "SELECT
                                    A.id,
                                    B.employee_id, B.isActive, B.first_name, B.last_name, B.email B.contact,
                                    C.dept_id, C.dept_code,
                                    D.position_id, D.position_desc,
                                    E.total_workHrs, E.d_from, E.d_to, E.days_works
                                    F.overtime, F.allowance, F.holidays_work, F.leave_days, F.sss, F.tax, F.pag_ibig, F.phil_health,
                                    F.sss_loan, F.tax_loan, F.pag_ibig_loan, F.phil_health_loan, F.ohters F.total_deduction
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


                                    if ($stmt->rowCount() > 0) {
                                        while ($row = $stmt->fetch()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['employee_id']; ?></td>
                                            <td><?php echo $row['first_name']; ?></td>
                                            <td><?php echo $row['last_name']; ?></td>
                                            <!-- <td><?php // echo $row['email']; ?></td> -->
                                            <td><?php echo $row['contact']; ?></td>
                                            <td><?php echo $row['dept_code']; ?></td>
                                            <td><?php echo $row['total_workHrs']; ?></td>
                                            <td><?php echo $row['d_from']; ?></td>
                                            <td><?php echo $row['d_to']; ?></td>
                                            <td><?php echo $row['days_works']; ?></td>
                                            <td><?php echo $row['overtime']; ?></td>
                                            <td><?php echo $row['allowance']; ?></td>
                                            <td><?php echo $row['holidays_work']; ?></td>
                                            <td><?php echo $row['leave_days']; ?></td>
                                            <td><?php echo $row['total_deduction']; ?></td>
                                        </tr>
                                    <?php }} ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php 
                }
        }   
        
        if($activeForm){ ?>       <!-- This is the main user interface (no value indicated) -->

                    <div class="container container-style">
                        <form action="UI_payroll.php" method="post">
                            <!-- form search-->
                            <div class="search-bg">
                                <div class="search">
                                    <input class="input-style search-style" placeholder="Search Employee ID" type="number" name="search_E_ID" id="search_E_ID">
                                    <button type="submit" name="search" id="search"><i class='bx bx-search bx-margin'></i></button>
                                </div>
                            </div>
                        </form>

                        <!-- form -->
                        <form>
                        
                            <label>
                                <input class="input-style" type="text" name="fname" id="fname" required readonly>
                                <p>First Name</p>
                            </label>
                            <label>
                                <input class="input-style" type="text" name="lname" id="lname" required readonly>
                                <p>Last Name</p>
                            </label>
                            <!-- <label>
                                <input class="input-style" type="email" name="email" id="email" required readonly>
                                <p>Email</p>
                            </label> -->
                            <label>
                                <input class="input-style removearrow" type="number" name="contact" id="contact" required readonly>
                                <p>Contact</p>
                            </label>
                            <label>
                                <select name="dept_id" id="dept_id" required>
                                    <option selected hidden> - Select - </option>
                                </select>
                                <p>Employee Department</p>
                            </label>
                            <label>
                                <input class="input-style removearrow" type="number" name="hours_work" id="hours_work" required readonly>
                                <p>Hours Work</p>
                            </label>
                            <label>
                                <input class="input-style removearrow" type="date" name="hours_work" id="hours_work" required readonly>
                                <p>Date From</p>
                            </label>
                            <label>
                                <input class="input-style removearrow" type="date" name="hours_work" id="hours_work" required readonly>
                                <p>Date To</p>
                            </label>
                            <label>
                                <input class="input-style" type="number" name="days_work" id="days_work" required readonly>
                                <p>Days Work</p>
                            </label>
                            <br>
                            <br>

                            <label class="b1">Over Time
                                <input class="b-size" type="number" name="" id="" required placeholder="0">
                            </label>
                            <label class="b2">Allowance
                                <input class="b-size" type="number" name="" id="" required placeholder="0">
                            </label>
                            <label class="b3">Holidays Work
                                <input class="b-size" type="number" name="" id="" required placeholder="0">
                            </label>
                            <label class="b4">Leave Days
                                <input class="b-size" type="number" name="" id="" required placeholder="0">
                            </label>
                            <label class="b5">SSS
                                <input class="b-size" type="number" name="" id="" required placeholder="0">
                            </label>
                            <label class="b6">Pag-ibig
                                <input class="b-size" type="number" name="" id="" required placeholder="0">
                            </label>
                            <label class="b7">Phil-Health
                                <input class="b-size" type="number" name="" id="" required placeholder="0">
                            </label>
                            <label class="b8">SSS-Loan
                                <input class="b-size" type="number" name="" id="" required placeholder="0">
                            </label>
                            <label class="b9">Pag-ibig loan
                                <input class="b-size" type="number" name="" id="" required placeholder="0">
                            </label>
                            <label class="b10">Phil-Health Loan
                                <input class="b-size" type="number" name="" id="" required placeholder="0">
                            </label>
                            <label class="b11">Others
                                <input class="b11-size" type="Text" name="" id="" required placeholder="0">
                            </label>
                            <label class="b12">Deduction Total
                                <input class="b12-size" type="number" name="" id="" required>
                            </label>

                            <button class="button" disabled>Save</button>
                            <button class="button" disabled>Update</button>
                            <button class="button" disabled>Delete</button>

                        </form>

                        <!------------------------------------------ TABLE BELOW IS FOR SHOWING DATA FROM DATABASE ---------------------------------------->
                        <div class="output">
                            <table class="table table-dark table-striped">
                                <thead>
                                    <tr>
                                        <th>E_ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <!-- <th>Email</th> -->
                                        <th>Contact</th>
                                        <th>Emp Dept</th>
                                        <th>Hrs_Wrks</th>
                                        <th>D_Frm</th>
                                        <th>D_To</th>
                                        <th>Total_wrkHrs</th>
                                        <th>O.T</th>
                                        <th>Allwnce</th>
                                        <th>Hlldy_wrk</th>
                                        <th>Lv.Dy</th>
                                        <th>Deductions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $pdo = $classPayroll->openConnection();
                                    $sql = "SELECT
                                    A.id,
                                    B.employee_id, B.isActive, B.first_name, B.last_name, B.email, B.contact,
                                    C.dept_id, C.dept_code,
                                    D.position_id, D.position_desc,
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
                                    WHERE B.isActive = 1 AND A.id > 0";

                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute();


                                    if ($stmt->rowCount() > 0) {
                                        while ($row = $stmt->fetch()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['employee_id']; ?></td>
                                            <td><?php echo $row['first_name']; ?></td>
                                            <td><?php echo $row['last_name']; ?></td>
                                            <!-- <td><?php //echo $row['email']; ?></td> -->
                                            <td><?php echo $row['contact']; ?></td>
                                            <td><?php echo $row['dept_code']; ?></td>
                                            <td><?php echo $row['total_workHrs']; ?></td>
                                            <td><?php echo $row['d_from']; ?></td>
                                            <td><?php echo $row['d_to']; ?></td>
                                            <td><?php echo $row['days_works']; ?></td>
                                            <td><?php echo $row['overtime']; ?></td>
                                            <td><?php echo $row['allowance']; ?></td>
                                            <td><?php echo $row['holidays_work']; ?></td>
                                            <td><?php echo $row['leave_days']; ?></td>
                                            <td><?php echo $row['total_deduction']; ?></td>
                                        </tr>
                                    <?php }} ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
            <?php 
        } ?>

    </body>


</html>