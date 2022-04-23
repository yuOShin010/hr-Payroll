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
        <link rel="stylesheet" href="../css/UI-add.css">
        <title>Schedule | Symtech</title>
    </head>

    <style>

        #btn {
            height: 10px;
            width: 10px;
        }
    </style>

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

        <?php
            $activeform = true;

            if(isset($_POST['search'])){     // This is the form that Active Save Button to save Set Schedule --
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
                    }
                }
        ?>
        <div class="container">
            <form action="../operator/UI_schedule.php" method="post">
                <div class="search-engine">
                    <label>Search For Employee ID </label>
                    <input type="number" name="search_E_ID" id="search_E_ID" >
                    <button type="submit" name="search" id="search">-></button>
                </div>
            </form>

            <form action="../php/CP_schedule.php" method="post">
                <div class="container-content">
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
                        <option selected value="<?php echo $dept_id ?>"><?php echo $dept_code ?></option>
                    </select><br>
                    <label>Position:</label>
                    <select name="position_id" id="position_id" required>
                        <option selected value="<?php echo $position_id ?>"><?php echo $position_desc ?></option>
                    </select><br><br>
                    
                    <label>Total WorkHrs:</label>
                    <input type="number" name="workHrs" id="workHrs"><br>
                    <label>From:</label>
                    <input type="date" name="d_from" id="d_from"><br>
                    <label>To:</label>
                    <input type="date" name="d_to" id="d_to">
                    <input type="button" onclick="computeDays()" id="btn"><br><br> <!-- button here for Compute days Work -->
                    <label>Days Work:</label>
                    <input readonly type="" name="daysWork" id="daysWork" ><br><br>

                    <button type="submit" name="set_schedule">Save</button>
                    <button disabled type="submit" name="updateDept" id="updateDept">Update</button>
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
                    ON A.sched_id = E.sched_id
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

            <form action="" method="post">
                <div class="container-content">
                <label>E_ID:</label>
                    <input type="number" name="E_ID" id="E_ID1" ><br>
                    <label>First Name:</label>
                    <input type="text" name="fname" id="fname1" ><br>
                    <label>Last Name:</label>
                    <input type="text" name="lname" id="lname1" ><br>
                    <label>Email:</label>
                    <input type="email" name="email" id="email1" ><br>
                    <label>Contact:</label>
                    <input type="number" name="contact" id="contact1" ><br>
                    <label>Employee Dept:</label>
                    <input type="text" name="dept_id" id="dept_id"><br>
                    <label>Position:</label>
                    <input type="text" name="position_id" id="position_id"><br><br>
                    <label>Total WorkHrs:</label>
                    <input type="number" name="workHrs" id="workHrs"><br>
                    <label>From:</label>
                    <input type="date" name="d_from" id="d_from"><br>
                    <label>To:</label>
                    <input type="date" name="d_to" id="d_to">
                    <input type="button" id="btn"><br><br>
                    <label>Days Work:</label>
                    <input type="number" name="daysWork" id="daysWork">
                    <br><br>

                    <button disabled type="submit">Save</button>
                    <button disabled type="submit">Update</button>
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