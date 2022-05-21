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

    <title>Schedule Management</title>

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
        <header class="tophead">
            <!-- DITO MO LAGAY YUNG LOG OUT MO -->
        </header>
        <!--_________________________________END OF TOPBAR___________________________________________-->

        <!-- </header>
    <?php

    if (isset($_SESSION['User'])) {
        echo '<h1>' . ' Schedule Management ' . '</h1>';
    } else {
        header("location:../index_OP.php");
    }

    ?>
    </header> -->

        <!--_________________________________END OF DASHBOARD__________________________________________-->

        <?php
        $activeform = true;

        if (isset($_POST['search'])) {     // This is the form that Active Save Button to save Set Schedule --
            $activeform = false;
            $search_EID = $_POST['search_E_ID'];

            $sql = "SELECT A.id,
                B.employee_id, B.isActive, B.first_name, B.last_name, B.email, B.contact,
                C.dept_id, C.dept_code,
                D.position_id, D.position_desc
                FROM tbl_employee_department_position AS A
                LEFT JOIN employee AS B
                ON A.employee_id = B.employee_id
                LEFT JOIN department AS C
                ON A.dept_id = C.dept_id
                LEFT JOIN position AS D
                ON A.position_id = D.position_id
                WHERE B.employee_id = ? AND B.isActive = 1 AND A.id > 0";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([$search_EID]);

            echo "Success Search";

            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch()) {
                    $E_ID = $row['employee_id'];
                    $fname = $row['first_name'];
                    $lname = $row['last_name'];
                    $email = $row['email'];
                    $contact = $row['contact'];
                    $dept_id = $row['dept_id'];
                    $dept_code = $row['dept_code'];
                    $position_id = $row['position_id'];
                    $position_desc = $row['position_desc'];
                }
            }
        ?>
            <!--_________________________________CONTENT__________________________________________-->


            <form action="../operator/UI_schedule.php" method="post">
                <!-- THIS IS FOR THE SEARCH BAR -->
                <div class="search-bg">
                    <div class="search">
                        <input class="input-style search-style" placeholder="Search Employee ID" type="number" name="search_E_ID" id="search_E_ID">
                        <button type="submit" name="search_e" id="search_e"><i class='bx bx-search size'></i></button>
                    </div>
                </div>
                <form action="../php/CP_schedule.php" method="post">
                    <label>
                        <input readonly type="number" name="E_ID" id="E_ID1" value="<?php echo $E_ID ?>">
                        E_ID:
                    </label>
                    <label>
                        <input readonly type="text" name="fname" id="fname1" value="<?php echo $fname ?>">
                        First Name:
                    </label>
                    <label>
                        <input readonly type="text" name="lname" id="lname1" value="<?php echo $lname ?>">
                        Last Name:
                    </label>
                    <label>
                        <input readonly type="email" name="email" id="email1" value="<?php echo $email ?>">
                        Email:
                    </label>
                    <label>
                        <input readonly type="number" name="contact" id="contact1" value="<?php echo $contact ?>">
                        Contact:
                    </label>
                    <label>
                        <select name="dept_id" id="dept_id" required>
                            Employee Dept:
                            <option selected value="<?php echo $dept_id ?>"><?php echo $dept_code ?></option>
                        </select>
                    </label>
                    <label>
                        <select name="position_id" id="position_id" required>
                            Position:
                            <option selected value="<?php echo $position_id ?>"><?php echo $position_desc ?></option>
                        </select>
                    </label>

                    <label>
                        <input readonly type="" name="daysWork" id="daysWork">
                        Days Work:
                    </label>

                    <button type="submit" name="set_schedule">Save</button>
                    <button disabled type="submit" name="updateDept" id="updateDept">Update</button>

                </form>
            </form>



            <!------------------------------------------ TABLE BELOW IS FOR SHOWING DATA FROM DATABASE ---------------------------------------->
            <div class="output">
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Total WorkHrs</th>
                            <th>D-From</th>
                            <th>D-To</th>
                            <th>Days of Work</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $pdo = $classPayroll->openConnection();

                        $sql = "SELECT
                    B.employee_id, B.isActive, B.first_name, B.last_name, B.email, B.contact,
                    C.dept_code,
                    D.position_desc,
                    E.total_workHrs, E.d_from, E.d_to, E.days_works
                    FROM tbl_employee_schedule AS A 
                    LEFT JOIN employee AS B
                    ON A.employee_id = B.employee_id
                    LEFT JOIN department AS C
                    ON A.dept_id = C.dept_id
                    LEFT JOIN position AS D
                    ON A.position_id = D.position_id
                    LEFT JOIN schedule AS E
                    ON A.sched_id = E.sched_id
                    WHERE B.isActive = 1 ORDER BY B.employee_id ASC;";

                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();

                        if ($stmt->rowCount() > 0) {
                            while ($row = $stmt->fetch()) {
                        ?>
                                <tr>
                                    <td><?php echo $row['employee_id']; ?></td>
                                    <td><?php echo $row['first_name']; ?></td>
                                    <td><?php echo $row['last_name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['contact']; ?></td>
                                    <td><?php echo $row['dept_code']; ?></td>
                                    <td><?php echo $row['position_desc']; ?></td>
                                    <td><?php echo $row['total_workHrs']; ?></td>
                                    <td><?php echo $row['d_from']; ?></td>
                                    <td><?php echo $row['d_to']; ?></td>
                                    <td><?php echo $row['days_works']; ?></td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>

            <?php
        }
        //  <!-- ------------------------------------------------------------------------------------------------------------------------------- -->

        if ($activeform) {    // This is the main user interface (no value indicated) --
            ?>

                <div class="container">
                    <form action="../operator/UI_schedule.php" method="post">

                        <div class="search-bg">
                            <div class="search">
                                <input class="input-style search-style" placeholder="Search Employee ID" type="number" name="search_E_ID" id="search_E_ID">
                                <button type="submit" name="search_e" id="search_e"><i class='bx bx-search size'></i></button>
                            </div>
                        </div>

                        <form action="" method="post">

                            <label>E_ID:
                                <input type="number" name="E_ID" id="E_ID1">
                            </label>
                            <label>First Name:
                                <input type="text" name="fname" id="fname1">
                            </label>
                            <label>Last Name:
                                <input type="text" name="lname" id="lname1">
                            </label>
                            <label>Email:
                                <input type="email" name="email" id="email1">
                            </label>
                            <label>Contact:
                                <input type="number" name="contact" id="contact1">
                            </label>
                            <label>Employee Dept:
                                <input type="text" name="dept_id" id="dept_id">
                            </label>
                            <label>Position:
                                <input type="text" name="position_id" id="position_id">
                            </label>
                            <form action="" method="post">
                                <input type="radio" name="cut" value="weekly" id="" required>Weekly
                                <input type="radio" name="cut" value="halfMonth" id="" required>half A Month
                                <button type="submit" name="btnCut">**</button>
                            </form>


                            <?php
                            if (isset($_POST['btnCut'])) {
                                $cutOff = $_POST['cut'];

                                if ($cutOff == "weekly") {
                            ?>
                                    <label>DATE FROM:
                                        <input type="date" name="from" id="dateFrom" style="margin-bottom: 10px;">
                                    </label>
                                    <label>DATE TO:
                                        <input type="date" name="to" id="dateTo" readonly>
                                    </label>
                                    <button onclick="dateManipulateWeek()">**</button> <!-- Button Here -->

                                    <label><input type="checkbox" name="" id="out1"> <span> SUN </span> </label> <input type="time" name="" id="T_I1" style="margin-left: 10px;"> <input type="time" name="" id="T_O1">
                                    <label><input type="checkbox" name="" id="out2"> <span> MON </span> </label> <input type="time" name="" id="T_I2" style="margin-left: 10px;"> <input type="time" name="" id="T_O2">
                                    <label><input type="checkbox" name="" id="out3"> <span> TUE </span> </label> <input type="time" name="" id="T_I3" style="margin-left: 10px;"> <input type="time" name="" id="T_O3">
                                    <label><input type="checkbox" name="" id="out4"> <span> WED </span> </label> <input type="time" name="" id="T_I4" style="margin-left: 10px;"> <input type="time" name="" id="T_O4"> <button onclick="set_allTime()">**</button>
                                    <label><input type="checkbox" name="" id="out5"> <span> THU </span> </label> <input type="time" name="" id="T_I5" style="margin-left: 10px;"> <input type="time" name="" id="T_O5">
                                    <label><input type="checkbox" name="" id="out6"> <span> FRI </span> </label> <input type="time" name="" id="T_I6" style="margin-left: 10px;"> <input type="time" name="" id="T_O6">
                                    <label><input type="checkbox" name="" id="out7"> <span> SAT </span> </label> <input type="time" name="" id="T_I7" style="margin-left: 10px;"> <input type="time" name="" id="T_O7">

                                <?php } elseif ($cutOff == "halfMonth") {   //  end of if ($cutOff == weekly) -->
                                ?>

                                    <label>DATE FROM:
                                        <input type="date" name="from" id="dateFrom" style="margin-bottom: 10px;">
                                    </label>
                                    <label>DATE TO:
                                        <input type="date" name="to" id="dateTo" readonly>
                                        <button onclick="dateManipulateMonth()">**</button> <!-- Button Here -->
                                    </label>
                                    <label><input type="checkbox" name="" id="out1"> <span> SUN </span> </label> <input type="time" name="" id="T_I1" style="margin-left: 10px;"> <input type="time" name="" id="T_O1">
                                    <label><input type="checkbox" name="" id="out2"> <span> MON </span> </label> <input type="time" name="" id="T_I2" style="margin-left: 10px;"> <input type="time" name="" id="T_O2">
                                    <label><input type="checkbox" name="" id="out3"> <span> TUE </span> </label> <input type="time" name="" id="T_I3" style="margin-left: 10px;"> <input type="time" name="" id="T_O3">
                                    <label><input type="checkbox" name="" id="out4"> <span> WED </span> </label> <input type="time" name="" id="T_I4" style="margin-left: 10px;"> <input type="time" name="" id="T_O4"> <button onclick="set_allTime()">**</button>
                                    <label><input type="checkbox" name="" id="out5"> <span> THU </span> </label> <input type="time" name="" id="T_I5" style="margin-left: 10px;"> <input type="time" name="" id="T_O5">
                                    <label><input type="checkbox" name="" id="out6"> <span> FRI </span> </label> <input type="time" name="" id="T_I6" style="margin-left: 10px;"> <input type="time" name="" id="T_O6">
                                    <label><input type="checkbox" name="" id="out7"> <span> SAT </span> </label> <input type="time" name="" id="T_I7" style="margin-left: 10px;"> <input type="time" name="" id="T_O7">


                                <?php } ?>
                                <!-- end of elseif ($cutOff == halfMonth) -->

                            <?php } ?>


                            <button disabled type="submit">Save</button>
                            <button disabled type="submit">Update</button>



                            <!------------------------------------------ TABLE BELOW IS FOR SHOWING DATA FROM DATABASE ---------------------------------------->
                            <div class="output">
                                <table class="table table-dark table-striped">
                                    <tr>
                                        <th>Employee ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Department</th>
                                        <th>Position</th>
                                        <th>Total WorkHrs</th>
                                        <th>D-From</th>
                                        <th>D-To</th>
                                        <th>Days of Work</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $pdo = $classPayroll->openConnection();

                                        $sql = "SELECT
                    B.employee_id, B.isActive, B.first_name, B.last_name, B.email, B.contact,
                    C.dept_code,
                    D.position_desc,
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
                    WHERE B.isActive = 1 ORDER BY B.employee_id ASC;";

                                        $stmt = $pdo->prepare($sql);
                                        $stmt->execute();

                                        if ($stmt->rowCount() > 0) {
                                            while ($row = $stmt->fetch()) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $row['employee_id']; ?></td>
                                                    <td><?php echo $row['first_name']; ?></td>
                                                    <td><?php echo $row['last_name']; ?></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['contact']; ?></td>
                                                    <td><?php echo $row['dept_code']; ?></td>
                                                    <td><?php echo $row['position_desc']; ?></td>
                                                    <td><?php echo $row['total_workHrs']; ?></td>
                                                    <td><?php echo $row['d_from']; ?></td>
                                                    <td><?php echo $row['d_to']; ?></td>
                                                    <td><?php echo $row['days_works']; ?></td>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } ?>
                        </form>
                </div>
</body>

</html>