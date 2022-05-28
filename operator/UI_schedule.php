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
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/dashboard.css">
        <link rel="stylesheet" href="../css/proper-placement.css">
        <link rel="stylesheet" href="../css/default.css">
        <title>Schedule | Symtech</title>
    </head>

    <script>
        function show() {
            document.getElementById('navigation').classList.toggle('active');
        }
    </script>

</head>

<body>
    <!-- DASHBOARD-->

    <div id="navigation">
        <!-- <div class="toggle-btn" onclick="show()">
            <span></span>
            <span></span>
            <span></span>
        </div> -->
        <div class="side-bar">
            <h3>SymTech</h3>
        </div>
        <ul>
             <li>
                <a href="#">
                    <!-- <i class='bx bx-bar-chart-square bx-flip-horizontal' style='color:#ffffff'  ></i> -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="float: left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="M3 5v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2H5c-1.103 0-2 .897-2 2zm16.001 14H5V5h14l.001 14z"></path><path d="M11 7h2v10h-2zm4 3h2v7h-2zm-8 2h2v5H7z"></path></svg>
                    <p>Dashboard</p>
                </a>
            </li>
             <li>
                <a href="../operator/UI_addEmployee.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="float:left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="M15 11h7v2h-7zm1 4h6v2h-6zm-2-8h8v2h-8zM4 19h10v-1c0-2.757-2.243-5-5-5H7c-2.757 0-5 2.243-5 5v1h2zm4-7c1.995 0 3.5-1.505 3.5-3.5S9.995 5 8 5 4.5 6.505 4.5 8.5 6.005 12 8 12z"></path></svg>
                    <p>Employee Management</p>
                </a>

            </li>
            <li>
                <a href="../operator/UI_setDepartment.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="float:left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="M7 14.001h2v2H7z"></path><path d="M19 2h-8a2 2 0 0 0-2 2v6H5c-1.103 0-2 .897-2 2v9a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2zM5 20v-8h6v8H5zm9-12h-2V6h2v2zm4 8h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V6h2v2z"></path></svg>
                    <p>Department Management</p>
                </a>
            </li>
            <li>
                <a href="../operator/UI_schedule.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="float:left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="M21 20V6c0-1.103-.897-2-2-2h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2zM9 18H7v-2h2v2zm0-4H7v-2h2v2zm4 4h-2v-2h2v2zm0-4h-2v-2h2v2zm4 4h-2v-2h2v2zm0-4h-2v-2h2v2zm2-5H5V7h14v2z"></path></svg>
                    <p>Scheduling Management</p>
                </a>
            </li>
            <li>
                <a href="../operator/UI_payroll.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="float:left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="M20 6c0-2.168-3.663-4-8-4S4 3.832 4 6v2c0 2.168 3.663 4 8 4s8-1.832 8-4V6zm-8 13c-4.337 0-8-1.832-8-4v3c0 2.168 3.663 4 8 4s8-1.832 8-4v-3c0 2.168-3.663 4-8 4z"></path><path d="M20 10c0 2.168-3.663 4-8 4s-8-1.832-8-4v3c0 2.168 3.663 4 8 4s8-1.832 8-4v-3z"></path></svg>
                    <p>Payroll Management</p>
                    <!-- style="float:left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1); -->
                </a>
            </li>
            <li>
                <a href="../operator/UI_employeeSalary.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="float:left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="M20 3H4c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zM4 19V5h16l.002 14H4z"></path><path d="M6 7h12v2H6zm0 4h12v2H6zm0 4h6v2H6z"></path></svg>
                    <p>Employee Salary Report</p>
                </a>
            </li>
            <li>
                <a href="../operator/UI_payslipReport.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="float:left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="m12 16 4-5h-3V4h-2v7H8z"></path><path d="M20 18H4v-7H2v7c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2v-7h-2v7z"></path></svg>
                    <p>Payslip Report/Print</p>
                </a>
            </li>
            <li>
                <a href="../operator/UI_companyReport.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="float:left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="M5 3H3v18h18v-2H5z"></path><path d="M13 12.586 8.707 8.293 7.293 9.707 13 15.414l3-3 4.293 4.293 1.414-1.414L16 9.586z"></path></svg>
                    <p>Company Report</p>
                </a>
            </li>
        </ul>

    </div>
    <header class="tophead">
        <!-- DITO MO LAGAY YUNG LOG OUT MO -->
        <?php

            if (isset($_SESSION['User'])) {
                echo '<h1>' . ' Welcome ' . $_SESSION['User'] . '</h1>';
                echo '<a href="../logout.php?logout">Logout</a>';
            } else {
                header("location:../index.php");
            }

        ?>
    </header>
<!--_________________________________END OF TOPBAR___________________________________________-->

<<<<<<< HEAD
        <!-- </header>
    <?php

    if (isset($_SESSION['User'])) {
        echo '<h1>' . ' Schedule Management ' . '</h1>';
    } else {
        header("location:../index.php");
    }

    ?>
    </header> -->
=======
>>>>>>> b57d4b8b21bd3541f7aeb2580ac9a29c0d65774d

<!--_________________________________END OF DASHBOARD__________________________________________-->
   
    <div class="container container-style">
        <?php
            $activeform = true;

            if(isset($_POST['search'])){     // This is the form active = false--
                $activeform = false;
                $setSchedule = true;
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

                // echo "Success Search";

                if($stmt->rowCount() > 0){
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
                        // for update credential
                        $total_workHrs = $row['total_workHrs'];
                        $d_from = $row['d_from'];
                        $d_to = $row['d_to'];
                        $days_works = $row['days_works'];
                    }

                } elseif (isset($_POST['search'])) {          // SET SCHEDULE SAVE ACTIVE OPTION -----

                    $setSchedule = false;

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

            
                ?>
                   
                    <form action="../operator/UI_schedule.php" method="post">
                        <div class="search-bg">
                                <div class="search">
                                    <input input class="input-style search-style" placeholder="Search Employee ID" type="number" name="search_E_ID" id="search_E_ID" >
                                    <button class="srch-btn" type="submit" name="search" id="search"><i class='bx bx-search bx-margin'></i></button>
                                </div>
                        </div>
                    </form>

                    <form action="../php/process.php" method="post">   <!-- Throw in process.php -->
                    
                            <label>
                                <input class="input-style" readonly type="number" name="E_ID" id="E_ID1" value="<?php echo $E_ID ?>">
                                <p>Employee ID</p>
                            </label>
                            <label>
                                <input class="input-style" readonly type="text" name="fname" id="fname1" value="<?php echo $fname ?>">
                                <p>First Name</p>
                            </label>
                            <label>
                                <input class="input-style" readonly type="text" name="lname" id="lname1" value="<?php echo $lname ?>">
                                <p>Last Name</p>
                            </label>
                            <label>
                                <input class="input-style" readonly type="email" name="email" id="email1" value="<?php echo $email ?>">
                                <p>Email</p>
                            </label>
                            <label>
                                <input class="input-style" readonly type="number" name="contact" id="contact1" value="<?php echo $contact ?>">
                                <p>Contact</p>
                            </label><br>
                            <label class="side-left">Employee Department:
                                <select class="option-size" name="dept_id" id="dept_id" required>
                                    <option selected hidden value="<?php echo $dept_id ?>"><?php echo $dept_code ?></option>
                                </select>
                            </label>
                            <label class="options-right">
                                <select class="option-size" name="position_id" id="position_id" required>
                                    <option selected hidden value="<?php echo $position_id ?>"><?php echo $position_desc ?></option>
                                </select>
                            </label>
                            <label>
                                <input class="input-style" type="number" name="workHrs" id="workHrs">
                                <p>Work Hours</p>
                            </label>
                            <label>
                                <input class="input-style" type="date" name="d_from" id="d_from">
                                <p>From</p>
                            </label>
                            <label>
                                <input class="input-style" type="date" name="d_to" id="d_to">
                                <input class="input-style" type="button" onclick="computeDays()" id="btn"> <!-- button here for Compute days Work -->
                                <p>From</p>
                            </label>
                            <label>
                                <input class="input-style" readonly type="text" name="daysWork" id="daysWork" >
                                <p>Days of Work</p>
                            </label>

                                <button class="button save" type="submit" name="set_schedule">Save</button>
                                <button disabled class="button" type="submit" name="updateDept" id="updateDept">Update</button>

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
                            ON A.employee_id = E.employee_id
                            WHERE B.isActive = 1 ORDER BY B.employee_id ASC;";

                            $stmt = $pdo->prepare($sql);
                            $stmt->execute();

                            if($stmt->rowCount() > 0){
                                while($row = $stmt->fetch()){
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
                        <?php }} ?>
                    </tbody>
            </table>
        </div>
                
            <?php    } 
                

<<<<<<< HEAD
        <!------------------------------------------ TABLE BELOW IS FOR SHOWING DATA FROM DATABASE ---------------------------------------->
        <table>
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
=======
                if ($setSchedule){ ?>       <!-- UPDATE SCHEDULE ACTIVE UPDATE BTN ----->
>>>>>>> b57d4b8b21bd3541f7aeb2580ac9a29c0d65774d

                    <!-- // For Update Schedule -->
                    
                        <form action="../operator/UI_schedule.php" method="post">
                            <div class="search-bg">
                                <div class="search">
                                    <input class="input-style search-style" placeholder="Search Employee ID" type="number" name="search_E_ID" id="search_E_ID">
                                    <button type="submit" name="search_e" id="search_e"><i class='bx bx-margin bx-search bx-margin'></i></button>
                                </div>
                            </div>
                        
                            <form action="../php/process.php" method="post">   <!-- Throw in process.php -->
                                <label>
                                    <input class="input-style" readonly type="number" name="E_ID" id="E_ID1" value="<?php echo $E_ID ?>">
                                    <p>Employee ID</p>
                                </label>
                                <label>
                                    <input class="input-style" readonly type="text" name="fname" id="fname1" value="<?php echo $fname ?>">
                                    <p>First Name</p>
                                </label>
                                <label>
                                    <input class="input-style" readonly type="text" name="lname" id="lname1" value="<?php echo $lname ?>">
                                    <p>Last Name</p>
                                </label>
                                <label>
                                    <input class="input-style" readonly type="email" name="email" id="email1" value="<?php echo $email ?>">
                                    <p>Email</p>
                                </label>
                                <label>
                                    <input class="input-style" readonly type="number" name="contact" id="contact1" value="<?php echo $contact ?>">
                                    <p>Contact</p>
                                </label><br>
                                <label class="side-left">Employee Department:
                                    <select class="option-size" name="dept_id" id="dept_id" required>
                                        <option selected hidden value="<?php echo $dept_id ?>"><?php echo $dept_code ?></option>
                                    </select>
                                </label>
                                <label class="options-right">Position:
                                    <select class="option-size" name="position_id" id="position_id" required>
                                        <option selected hidden value="<?php echo $position_id ?>"><?php echo $position_desc ?></option>
                                    </select>
                                </label>
                                <label>Total WorkHrs:
                                    <input class="input-style" class="input-style" type="number" name="workHrs" id="workHrs" value="<?php echo $total_workHrs ?>">
                                </label>
                                <label>From:
                                    <input class="input-style" type="date" name="d_from" id="d_from" value="<?php echo $d_from ?>">
                                </label>
                                <label>To:
                                    <input class="input-style" type="date" name="d_to" id="d_to" value="<?php echo $d_to ?>">
                                    <input class="input-style" type="button" onclick="computeDays()" id="btn"> <!-- button here for Compute days Work -->
                                </label>
                                <label>Days Work:
                                    <input class="input-style" readonly type="text" name="daysWork" id="daysWork" value="<?php echo $days_works ?>">
                                </label>
                                <button class="button" disabled type="submit" name="set_schedule">Save</button>
                                <button class="button update" type="submit" name="updateSchedule">Update</button>
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
                            ON A.employee_id = E.employee_id
                            WHERE B.isActive = 1 ORDER BY B.employee_id ASC;";

                            $stmt = $pdo->prepare($sql);
                            $stmt->execute();

                            if($stmt->rowCount() > 0){
                                while($row = $stmt->fetch()){
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
                        <?php }} ?>
                    </tbody>
            </table>
        </div>                               

                <?php }

            }
        //  <!-- ------------------------------------------------------------------------------------------------------------------------------- -->

                    if($activeform){    // This is the main user interface (no value indicated) --
                ?>
<<<<<<< HEAD
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
                <?php }} ?>
            </tbody>
        </table>
        <?php    } 
        

        if ($setSchedule){ ?>       <!-- UPDATE SCHEDULE ACTIVE UPDATE BTN ----->

                <!-- // For Update Schedule -->
                <div class="container">
                    <form action="../operator/UI_schedule.php" method="post">
                        <div class="search-engine">
                            <label>Search For Employee ID </label>
                            <input type="number" name="search_E_ID" id="search_E_ID" >
                            <button type="submit" name="search" id="search">-></button>
                        </div>
                    </form>
                </div>

                <div class="container-content">
                    <form action="../php/process.php" method="post">   <!-- Throw in process.php -->
                        <label>E_ID:</label>
                        <input readonly type="number" name="E_ID" id="E_ID1" value="<?php echo $E_ID ?>"><br>
                        <label>First Name:</label>
                        <input readonly type="text" name="fname" id="fname1" value="<?php echo $fname ?>"><br>
                        <label>Last Name:</label>
                        <input readonly type="text" name="lname" id="lname1" value="<?php echo $lname ?>"><br>
                        <label>Email:</label>
                        <input readonly type="email" name="email" id="email1" value="<?php echo $email ?>"><br>
                        <label>Contact:</label>
                        <input readonly type="number" name="contact" id="contact1" value="<?php echo $contact ?>"><br>
                        <label>Employee Dept:</label>
                        <select name="dept_id" id="dept_id" required>
                            <option selected hidden value="<?php echo $dept_id ?>"><?php echo $dept_code ?></option>
                        </select><br>
                        <label>Position:</label>
                        <select name="position_id" id="position_id" required>
                            <option selected hidden value="<?php echo $position_id ?>"><?php echo $position_desc ?></option>
                        </select><br><br>
                        
                        <label>Total WorkHrs:</label>
                        <input type="number" name="workHrs" id="workHrs" value="<?php echo $total_workHrs ?>"><br>
                        <label>From:</label>
                        <input type="date" name="d_from" id="d_from" value="<?php echo $d_from ?>"><br>
                        <label>To:</label>
                        <input type="date" name="d_to" id="d_to" value="<?php echo $d_to ?>">
                        <input type="button" onclick="computeDays()" id="btn"><br><br> <!-- button here for Compute days Work -->
                        <label>Days Work:</label>
                        <input readonly type="text" name="daysWork" id="daysWork" value="<?php echo $days_works ?>"><br><br>

                        <button disabled type="submit" name="set_schedule">Save</button>
                        <button type="submit" name="updateSchedule">Update</button>
                    </form>
                </div>
            <hr>        

            <!------------------------------------------ TABLE BELOW IS FOR SHOWING DATA FROM DATABASE ---------------------------------------->
            <table>
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
                        ON A.employee_id = E.employee_id
                        WHERE B.isActive = 1 ORDER BY B.employee_id ASC;";

                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();

                        if($stmt->rowCount() > 0){
                            while($row = $stmt->fetch()){
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
                    <?php }} ?>
                </tbody>
            </table>


            <?php 
        }

    }
//  <!-- ------------------------------------------------------------------------------------------------------------------------------- -->

            if($activeform){    // This is the main user interface (no value indicated) --
        ?>
  
        <div class="container">
            <form action="../operator/UI_schedule.php" method="post">
                <div class="search-engine">
                    <label>Search For Employee ID </label>
                    <input type="number" name="search_E_ID" id="search_E_ID" >
                    <button type="submit" name="search" id="search">-></button>
                </div>
            </form>
=======
        
            
                <form action="../operator/UI_schedule.php" method="post">
                        <div class="search-bg">
                            <div class="search">
                                <input class="input-style search-style" placeholder="Search Employee ID" type="number" name="search_E_ID" id="search_E_ID">
                                <button type="submit" name="search_e" id="search_e"><i class='bx bx-search bx-margin'></i></button>
                            </div>
                        </div>
                    <form action="" method="post"> 
                        <label>
                            <input class="input-style" type="text" name="fname" id="fname1" >
                            <p>Employee ID</p>
                        </label>
                        <label>
                            <input class="input-style" type="text" name="lname" id="lname1" >
                            <p>Last Name</p>
                        </label>
                        <label>
                            <input class="input-style" type="email" name="email" id="email1" >
                            <p>Email</p>
                        </label>
                        <label>
                            <input class="input-style" type="number" name="contact" id="contact1" >
                            <p>Contact</p>
                        </label><br>
                        <label>Employee Department:
                            <input class="input-style" type="text" name="dept_id" id="dept_id">
                        </label>
                        <label>Position:
                            <input class="input-style" type="text" name="position_id" id="position_id">
                        </label>
                        <label>
                            <input class="input-style" type="number" name="workHrs" id="workHrs">
                            <p>Total WorkHrs</p>
                        </label>
                        <label>
                            <input class="input-style" type="date" name="d_from" id="d_from">
                            <p>From</p>
                        </label>
                        <label>
                            <input class="input-style" type="date" name="d_to" id="d_to">
                            <input type="button save" onclick="computeDays()" id="btn">
                            <p>To</p>
                        </label>
                        <label>
                            <input class="input-style" type="number" name="daysWork" id="daysWork">
                            <p>Days Work</p>
                        </label>
                        <button class="button" disabled type="submit">Save</button>
                        <button class="button" disabled type="submit">Update</button>
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
                            ON A.employee_id = E.employee_id
                            WHERE B.isActive = 1 ORDER BY B.employee_id ASC;";

                            $stmt = $pdo->prepare($sql);
                            $stmt->execute();

                            if($stmt->rowCount() > 0){
                                while($row = $stmt->fetch()){
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
                        <?php }} ?>
                    </tbody>
                </table>   
>>>>>>> b57d4b8b21bd3541f7aeb2580ac9a29c0d65774d
        </div>
    </div>
        <?php } ?>

    </body>

<script>

    function computeDays() {
        var d1 = document.getElementById('d_from').value;
        var d2 = document.getElementById('d_to').value;
        
        const dateOne = new Date(d1);
        const dateTwo = new Date(d2);
        const time = Math.abs(dateTwo - dateOne);
        const days = Math.ceil(time / (1000 * 60 * 60 * 24));
        document.getElementById("daysWork").value=days+1;
    }

</script>

</html>