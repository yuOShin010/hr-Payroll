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
    <link rel="stylesheet" href="../css/proper-placement.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/default.css">
    <title>Department Management</title>

    <script>
        function show() {
            document.getElementById('navigation').classList.toggle('active');
        }
    </script>


</head>

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

if (isset($_SESSION['User'])) {
    echo '<h1>' . ' Welcome ' . $_SESSION['User'] . '</h1>';
    echo '<a href="logout_OP.php?logout">Logout</a>';
} else {
    header("location:../index_OP.php");
}

?>

</header>

<!-- END DASHBOARD -->

<body>
    <!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------  -->
    <!-- ../php/CP_setDept.php -->\
    <div class="container">
        <?php

        $activeForm = true;  // this boolean is for hiding form element

        if (isset($_POST['srch1'])) {
            $activeForm = false;
            $setDepartment = true;

            $search_Eid = $_POST['srch'];
            $sql = "SELECT
                    B.employee_id, B.isActive, B.first_name, B.last_name, B.email, B.contact, A.id, A.dept_id, D.dept_code, A.position_id, C.position_desc
                    FROM tbl_employee_department_position AS A
                    LEFT JOIN employee AS B
                    ON A.employee_id = B.employee_id
                    LEFT JOIN position AS C
                    ON A.position_id = C.position_id
                    LEFT JOIN department AS D
                    ON A.dept_id = D.dept_id
                    WHERE B.employee_id = ? AND B.isActive = 1 AND A.id > 0";
            // $sql = "SELECT * FROM tbl_employee_department_position WHERE employee_id = ?";
            // $sql = "SELECT * FROM employee WHERE employee_id = ? AND isActive = 1";
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
            } elseif (isset($_POST['srch1'])) {                                                               // SET DEPARTMENT SAVE OPTION -----

                $setDepartment = false;
                $search_Eid = $_POST['srch'];
                $sql = "SELECT * FROM employee WHERE employee_id = ? AND isActive = 1";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$search_Eid]);

                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch()) {

                        $E_ID = $row['employee_id'];
                        $fname = $row['first_name'];
                        $lname = $row['last_name'];
                        $email = $row['email'];
                        $contact = $row['contact'];
                    }
                } else {
                    echo ("<script LANGUAGE='JavaScript'> window.alert('No employee Found ....');
                window.location.href='../operator/UI_setDepartment.php'; </script>");
                }


        ?>

                <form action="../operator/UI_setDepartment.php" method="post">
                    <!-- form search -->
                    <div class="search-bg">
                        <div class="search">
                            <input class="input-style search-style" placeholder="Search Employee ID" type="number" name="search_E_ID" id="search_E_ID">
                            <button type="submit" name="search_e" id="search_e"><i class='bx bx-search size'></i></button>
                        </div>
                    </div>
                    <form action="../php/process.php" method="post">
                        <!-- form set department -->
                        <label>
                            E_ID:
                            <input class="input-style" readonly type="number" name="E_ID" id="E_ID1" value="<?php echo $E_ID ?>"><br>
                        </label>
                        <label>First Name:
                            <input class="input-style" readonly type="text" name="fname" id="fname1" value="<?php echo $fname ?>"><br>
                        </label>
                        <label>Last Name:
                            <input class="input-style" readonly type="text" name="lname" id="lname1" value="<?php echo $lname ?>"><br>
                        </label>
                        <label>Email:
                            <input class="input-style" readonly type="email" name="email" id="email1" value="<?php echo $email ?>"><br>
                        </label>
                        <label>Contact:
                            <input class="input-style" readonly type="number" name="contact" id="contact1" value="<?php echo $contact ?>"><br>
                        </label>
                        <label>Employee Dept:
                            <select name="dept_id" id="dept_id" required>
                                <option selected disabled value="">- Select -</option>
                                <option value="1">BSIT</option>
                                <option value="2">BSOA</option>
                                <option value="3">BSED</option>
                                <option value="4">BEED</option>
                                <option value="5">BSCRIM</option>
                                <option value="6">BSTM</option>
                            </select>

                        </label>
                        <label>Position:
                            <select name="position_id" id="position_id" required>
                                <option selected disabled value="">- Select -</option>
                                <option value="1">Dept. Head</option>
                                <option value="2">Teacher</option>
                                <option value="3">Office Staff</option>
                                <option value="4">Secretary</option>
                                <option value="5">Utility</option>
                            </select><br>
                        </label>
                        <button type="submit" name="setDepartment" onclick="undisableTxt()">Save</button>
                        <button disabled type="submit" name="updateDept" id="updateDept">Update</button>
                        <!-- <button type="submit" name="deleteDept" id="deleteDept">Delete</button> -->
                    </form>
                </form>


                <!------------------------------------------ TABLE BELOW IS FOR SHOWING DATA FROM DATABASE (tbl_employee_department_position) ---------------------------------------->


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
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $pdo = $classPayroll->openConnection();

                        $sql = "SELECT
                        B.employee_id, B.isActive, B.first_name, B.last_name, B.email, B.contact, C.dept_code, D.position_desc
                        FROM tbl_employee_department_position AS A 
                        LEFT JOIN employee AS B
                        ON A.employee_id = B.employee_id
                        LEFT JOIN department AS C
                        ON A.dept_id = C.dept_id
                        LEFT JOIN position AS D
                        ON A.position_id = D.position_id
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
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            <?php
            }

            if ($setDepartment) {                 // UPDATE SET DEPARTMENT UPDATE OPTION -----
            ?>

                
                    <form action="../operator/UI_setDepartment.php" method="post">
                        <!-- form search -->
                        <div class="search-bg">
                            <div class="search">
                                <input class="input-style search-style" placeholder="Search Employee ID" type="number" name="search_E_ID" id="search_E_ID">
                                <button type="submit" name="search_e" id="search_e"><i class='bx bx-search size'></i></button>
                            </div>
                        </div>
                    </form>
                

                <form action="../php/process.php" method="post">
                    <!-- form update department -->
                    <label>E_ID:
                    <input class="input-style" readonly type="number" name="E_ID" id="E_ID2" value="<?php echo $E_ID ?>"><br>
                    </label>
                    <label>First Name:
                    <input class="input-style" readonly type="text" name="fname" id="fname2" value="<?php echo $fname ?>"><br>
                    </label>
                    <label>Last Name:
                    <input class="input-style" readonly type="text" name="lname" id="lname2" value="<?php echo $lname ?>"><br>
                    </label>
                    <label>Email:
                    <input class="input-style" readonly type="email" name="email" id="email2" value="<?php echo $email ?>"><br>
                    </label>
                    <label>Contact:</label>
                    <input class="input-style" readonly type="number" name="contact" id="contact2" value="<?php echo $contact ?>"><br>
                    
                    <label>Employee Dept:
                        <select name="dept_id" id="dept_id" required>
                            <option selected disabled value="<?php echo $dept_code; ?>"><?php echo $dept_code; ?></option>
                            <optgroup label="-Select New-"></optgroup>
                            <option value="1">BSIT</option>
                            <option value="2">BSOA</option>
                            <option value="3">BSED</option>
                            <option value="4">BEED</option>
                            <option value="5">BSCRIM</option>
                            <option value="6">BSTM</option>
                        </select>
                        </label>

                    <label>Position:
                        <select name="position_id" id="position_id" required>
                            <option selected disabled value="<?php echo $position_desc; ?>"><?php echo $position_desc; ?></option>
                            <optgroup label="-Select New-"></optgroup>
                            <option value="1">Dept. Head</option>
                            <option value="2">Teacher</option>
                            <option value="3">Office Staff</option>
                            <option value="4">Secretary</option>
                            <option value="5">Utility</option>
                        </select>
                    </label>

                    <button disabled type="submit" name="setDepartment">Save</button>
                    <button type="submit" name="updateDept" id="updateDept" onclick="undisableTxt2()">Update</button>
                    <!-- <button type="submit" name="deleteDept" id="deleteDept">Delete</button> -->
                </form>

                <!------------------------------------------ TABLE BELOW IS FOR SHOWING DATA FROM DATABASE (tbl_employee_department_position) ---------------------------------------->

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
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $pdo = $classPayroll->openConnection();

                        $sql = "SELECT
                    B.employee_id, B.isActive, B.first_name, B.last_name, B.email, B.contact, C.dept_code, D.position_desc
                    FROM tbl_employee_department_position AS A 
                    LEFT JOIN employee AS B
                    ON A.employee_id = B.employee_id
                    LEFT JOIN department AS C
                    ON A.dept_id = C.dept_id
                    LEFT JOIN position AS D
                    ON A.position_id = D.position_id
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
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>

            <?php

            }
        }

        if ($activeForm) { ?>
            <!-- this is the 1st interface of set department module -->

            <!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------  -->
            
                <form action="UI_setDepartment.php" method="post">
                    <!-- form search -->
                   <div class="search-bg">
                        <div class="search">
                            <input class="input-style search-style" placeholder="Search Employee ID" type="number" name="search_E_ID" id="search_E_ID">
                            <button type="submit" name="search_e" id="search_e"><i class='bx bx-search size'></i></button>
                        </div>
                    </div>
                </form>
            

            <form action="" method="">
                <!-- form no action and button enable -->
                <label>E_ID:
                    <input class="input-style" type="number" name="E_ID" id="E_ID">
                </label>
                <label>First Name:
                    <input class="input-style" type="text" name="fname" id="fname">
                </label>
                <label>Last Name:
                    <input class="input-style" type="text" name="lname" id="lname">
                </label>
                <label>Email:
                    <input class="input-style" type="email" name="email" id="email">
                </label>
                <label>Contact:
                    <input class="input-style" type="number" name="contact" id="contact">
                </label>
                <label>Employee Dept:
                    <select name="dept" id="dept" required>
                        <option selected disabled value="">- Select -</option>
                        <option value="1">BSIT</option>
                        <option value="2">BSOA</option>
                        <option value="3">BSED</option>
                        <option value="4">BEED</option>
                        <option value="5">BSCRIM</option>
                        <option value="6">BSTM</option>
                    </select>
                </label>
                <label>Position:
                    <select name="position" id="position" required>
                        <option selected disabled value="">- Select -</option>
                        <option value="1">Dept. Head</option>
                        <option value="2">Teacher</option>
                        <option value="3">Office Staff</option>
                        <option value="4">Secretary</option>
                        <option value="5">Utility</option>
                    </select>
                </label>
                <!-- BUTTONS -->
                <button disabled type="submit" name="setDepartment">Save</button>
                <button disabled="disabled">Update</button>


            </form>

            <!------------------------------------------ TABLE BELOW IS FOR SHOWING DATA FROM DATABASE (tbl_employee_department_position) ---------------------------------------->

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
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $pdo = $classPayroll->openConnection();

                        $sql = "SELECT
                    B.employee_id, B.isActive, B.first_name, B.last_name, B.email, B.contact, C.dept_code, D.position_desc
                    FROM tbl_employee_department_position AS A 
                    LEFT JOIN employee AS B
                    ON A.employee_id = B.employee_id
                    LEFT JOIN department AS C
                    ON A.dept_id = C.dept_id
                    LEFT JOIN position AS D
                    ON A.position_id = D.position_id
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
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
</body>

<!-- ------------------------ JAVA SCRIPT ----------------------- -->
<script>
    function undisableTxt() {
        document.getElementById("E_ID1").disabled = false;
        document.getElementById("fname1").disabled = false;
        document.getElementById("lname1").disabled = false;
        document.getElementById("email1").disabled = false;
        document.getElementById("contact1").disabled = false;
    }

    function undisableTxt2() {
        document.getElementById("E_ID2").disabled = false;
    }
</script>


</html>