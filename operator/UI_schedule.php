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
    <link rel="stylesheet" href="../css/UI_schedule.css">
    <title>Payroll | Symtech</title>
</head>
<body>
    <!-- DASHBOARD -->

    <div class="admin-dashboard"> 
            <div class="home-sidebar">
                <img  class="home-logo" src="https://img.icons8.com/glyph-neue/2x/home-page.png" alt="logo">
            </div>
              <div class="top-bar">
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
           
            </div>
        
           
    
        <header class="secondtop-bar">
        <?php 

            if(isset($_SESSION['User']))
            {
                echo '<h1>'.' Welcome to Schedule Management '.'</h1>';
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
        </div>

        <div class="container2">
            <form action="../php/CP_schedule.php" method="post">
                <div class="container-content">
                    <input readonly type="number" name="E_ID" id="E_ID1" value="<?php echo $E_ID ?>">
                    <label>E_ID:</label>
                </div>
                <div class="container-content">  
                    <input readonly type="text" name="fname" id="fname1" value="<?php echo $fname ?>">
                    <label>First Name:</label>
                </div>
                <div class="container-content">  
                    <input readonly type="text" name="lname" id="lname1" value="<?php echo $lname ?>">
                    <label>Last Name:</label>
                </div>
                <div class="container-content">    
                    <input readonly type="email" name="email" id="email1" value="<?php echo $email ?>">
                    <label>Email:</label>
                </div>
                <div class="container-content">    
                    <input readonly type="number" name="contact" id="contact1" value="<?php echo $contact ?>">
                    <label>Contact:</label>
                </div>   
                <div class="container-content-select">
                    <select name="dept_id" id="dept_id" required>
                    <label>Employee Dept:</label>
                        <option selected value="<?php echo $dept_id ?>"><?php echo $dept_code ?></option>
                    </select>
                </div>
                <div class="container-content-select">
                    <select name="position_id" id="position_id" required>
                    <label>Position:</label>
                        <option selected value="<?php echo $position_id ?>"><?php echo $position_desc ?></option>
                    </select><br><br>
                    
                    
                    
                    <input readonly type="" name="daysWork" id="daysWork" ><br><br>
                    <label>Days Work:</label>
                </div>
                <div class="container-content-select">
                    <button type="submit" name="set_schedule">Save</button>
                   <button disabled type="submit" name="updateDept" id="updateDept">Update</button>
                </div>
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

                    <form action="" method="post">
        <input type="radio" name="cut" value="weekly" id="" required >Weekly
        <input type="radio" name="cut" value="halfMonth" id="" required >half A Month
        <button type="submit" name="btnCut">**</button>
    </form>
    <br>
    <hr>
    <br>

    <?php 
        if(isset($_POST['btnCut'])){
            $cutOff = $_POST['cut'];

            if($cutOff == "weekly"){
    ?>
                <label>DATE FROM:</label>
                <input type="date" name="from" id="dateFrom" style="margin-bottom: 10px;">
                <br>
                <label>DATE TO:</label>    
                <input type="date" name="to" id="dateTo" readonly>
                <button onclick="dateManipulateWeek()">**</button>   <!-- Button Here -->
                <hr>
                <label><input type="checkbox" name="" id="out1"> <span> SUN </span> </label>   <input type="time" name="" id="T_I1" style="margin-left: 10px;">   <input type="time" name="" id="T_O1">   <br>
                <label><input type="checkbox" name="" id="out2"> <span> MON </span> </label>   <input type="time" name="" id="T_I2" style="margin-left: 10px;">   <input type="time" name="" id="T_O2">   <br>
                <label><input type="checkbox" name="" id="out3"> <span> TUE </span> </label>   <input type="time" name="" id="T_I3" style="margin-left: 10px;">   <input type="time" name="" id="T_O3">   <br>
                <label><input type="checkbox" name="" id="out4"> <span> WED </span> </label>   <input type="time" name="" id="T_I4" style="margin-left: 10px;">   <input type="time" name="" id="T_O4">   <button onclick="set_allTime()">**</button>   <br>
                <label><input type="checkbox" name="" id="out5"> <span> THU </span> </label>   <input type="time" name="" id="T_I5" style="margin-left: 10px;">   <input type="time" name="" id="T_O5">   <br>
                <label><input type="checkbox" name="" id="out6"> <span> FRI </span> </label>   <input type="time" name="" id="T_I6" style="margin-left: 10px;">   <input type="time" name="" id="T_O6">   <br>
                <label><input type="checkbox" name="" id="out7"> <span> SAT </span> </label>   <input type="time" name="" id="T_I7" style="margin-left: 10px;">   <input type="time" name="" id="T_O7">   <br>

    <?php } elseif($cutOff == "halfMonth"){   //  end of if ($cutOff == weekly) -->
        ?>  

                <label>DATE FROM:</label>
                <input type="date" name="from" id="dateFrom" style="margin-bottom: 10px;">
                <br>
                <label>DATE TO:</label>    
                <input type="date" name="to" id="dateTo" readonly>
                <button onclick="dateManipulateMonth()">**</button>     <!-- Button Here -->
                <hr>
                <label><input type="checkbox" name="" id="out1"> <span> SUN </span> </label>   <input type="time" name="" id="T_I1" style="margin-left: 10px;">   <input type="time" name="" id="T_O1">   <br>
                <label><input type="checkbox" name="" id="out2"> <span> MON </span> </label>   <input type="time" name="" id="T_I2" style="margin-left: 10px;">   <input type="time" name="" id="T_O2">   <br>
                <label><input type="checkbox" name="" id="out3"> <span> TUE </span> </label>   <input type="time" name="" id="T_I3" style="margin-left: 10px;">   <input type="time" name="" id="T_O3">   <br>
                <label><input type="checkbox" name="" id="out4"> <span> WED </span> </label>   <input type="time" name="" id="T_I4" style="margin-left: 10px;">   <input type="time" name="" id="T_O4">   <button onclick="set_allTime()">**</button>   <br>
                <label><input type="checkbox" name="" id="out5"> <span> THU </span> </label>   <input type="time" name="" id="T_I5" style="margin-left: 10px;">   <input type="time" name="" id="T_O5">   <br>
                <label><input type="checkbox" name="" id="out6"> <span> FRI </span> </label>   <input type="time" name="" id="T_I6" style="margin-left: 10px;">   <input type="time" name="" id="T_O6">   <br>
                <label><input type="checkbox" name="" id="out7"> <span> SAT </span> </label>   <input type="time" name="" id="T_I7" style="margin-left: 10px;">   <input type="time" name="" id="T_O7">   <br>
                

        <?php } ?> <!-- end of elseif ($cutOff == halfMonth) -->
          
    <?php } ?>
                   

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
</html>