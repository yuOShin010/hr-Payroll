<?php
    require_once('../php/classes/payrollClass.php');
    $pdo = $classPayroll->openConnection();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Set Department | Symtech</title>
    </head>

    <style>
        body {
            background-color: #6C6169;
        }

        form {
            text-align: center;
            margin-top: 5px;       
        }

        label, input , textarea, select{
            margin-top: 10px;
        }

        button {
            margin-top: 8px;
        }

        table{
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, tr, th, td{
            border:1px solid black;
        }

        th, td{
            padding: 10px 20px;
        }
    </style>

    <body>
   <!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------  -->
    <!-- ../php/CP_setDept.php -->
    <?php 

     $activeForm = true;  // this boolean is for hiding form element
    
        if(isset($_POST['srch1'])){
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
                        WHERE B.employee_id = ? AND B.isActive = 1 AND A.id > 0" ;
                // $sql = "SELECT * FROM tbl_employee_department_position WHERE employee_id = ?";
                // $sql = "SELECT * FROM employee WHERE employee_id = ? AND isActive = 1";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$search_Eid]);
                
                if($stmt->rowCount() > 0){
                    while($row = $stmt->fetch()){
                        
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
                } elseif(isset($_POST['srch1'])){                                                               // SET DEPARTMENT SAVE OPTION -----
                    
                    $setDepartment = false;
                    $search_Eid = $_POST['srch'];
                    $sql = "SELECT * FROM employee WHERE employee_id = ? AND isActive = 1";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$search_Eid]);
                
                        if($stmt->rowCount() > 0){
                            while($row = $stmt->fetch()){
                                
                                $E_ID = $row['employee_id'];
                                $fname = $row['first_name'];
                                $lname = $row['last_name'];
                                $email = $row['email'];
                                $contact = $row['contact'];
                            }
                        } else {
                            echo ("<script LANGUAGE='JavaScript'> window.alert('No employee Found ....');
                    window.location.href='http://localhost/hr_payroll/user_interface/UI_setDepartment.php'; </script>");
                        }

               ?>     <form action="../user_interface/UI_setDepartment.php" method="post">
                    <div>
                        <label>Search For Employee E_ID:</label>
                        <input type="number" name="srch" id="srch" >
                        <button type="submit" name="srch1" id="srch1">-></button>
                    </div>
                </form>
    
                <form action="../php/CP_setDept.php" method="post">
    
                    <label>E_ID:</label>
                    <input disabled type="number" name="E_ID" id="E_ID1" value="<?php echo $E_ID ?>"><br>
                    <label>First Name:</label>
                    <input disabled type="text" name="fname" id="fname1" value="<?php echo $fname ?>"><br>
                    <label>Last Name:</label>
                    <input disabled type="text" name="lname" id="lname1" value="<?php echo $lname ?>"><br>
                    <label>Email:</label>
                    <input disabled type="email" name="email" id="email1" value="<?php echo $email ?>"><br>
                    <label>Contact:</label>
                    <input disabled type="number" name="contact" id="contact1" value="<?php echo $contact ?>"><br>
                    <label>Employee Dept:</label>
                    <select name="dept_id" id="dept_id" required>
                        <option selected disabled value="">- Select -</option>
                        <option value="1">BSIT</option>
                        <option value="2">BSOA</option>
                        <option value="3">BSED</option>
                        <option value="4">BEED</option>
                        <option value="5">BSCRIM</option>
                        <option value="6">BSTM</option>
                    </select> <br>
                    <!-- <input list="dept1" name="dept" id="dept">
                    <datalist id="dept1">
                        <option value="BSIT">
                        <option value="BSOA">
                        <option value="BSED">
                        <option value="BEED">
                        <option value="BSCRIM">
                        <option value="BSTM">
                    </datalist> <br> -->
                    <label>Position:</label>
                    <select name="position_id" id="position_id" required>
                        <option selected disabled value="">- Select -</option>
                        <option value="1">Dept. Head</option>
                        <option value="2">Teacher</option>
                        <option value="3">Office Staff</option>
                        <option value="4">Secretary</option>
                        <option value="5">Utility</option>
                    </select><br>
    
                    <button type="submit" name="setDepartment" onclick="undisableTxt()">Save</button>
                    <button disabled type="submit" name="updateDept" id="updateDept">Update</button>
                    <!-- <button type="submit" name="deleteDept" id="deleteDept">Delete</button> -->
    
            </form>
    
            
    
                <br><br>   <hr>   <br><br>      
    
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
                        </tr>
                        <?php }} ?>
                    </tbody>
                </table>
            <?php
                } 
            
             if($setDepartment){                                                                     // UPDATE SET DEPARTMENT UPDATE OPTION -----
    ?>

            <form action="../user_interface/UI_setDepartment.php" method="post">
                <div>
                    <label>Search For Employee E_ID:</label>
                    <input type="number" name="srch" id="srch" >
                    <button type="submit" name="srch1" id="srch1">-></button>
                </div>
            </form>

            <form action="../php/CP_setDept.php/" method="post">

                <label>E_ID:</label>
                <input disabled type="number" name="E_ID" id="E_ID2" value="<?php echo $E_ID ?>"><br>
                <label>First Name:</label>
                <input disabled type="text" name="fname" id="fname2" value="<?php echo $fname ?>"><br>
                <label>Last Name:</label>
                <input disabled type="text" name="lname" id="lname2" value="<?php echo $lname ?>"><br>
                <label>Email:</label>
                <input disabled type="email" name="email" id="email2" value="<?php echo $email ?>"><br>
                <label>Contact:</label>
                <input disabled type="number" name="contact" id="contact2" value="<?php echo $contact ?>"><br>
                <label>Employee Dept:</label>
                <select name="dept_id" id="dept_id" required>
                <option selected disabled value="<?php echo $dept_code ;?>"><?php echo $dept_code ;?></option>
                    <optgroup label="-Select New-"></optgroup>
                    <option value="1">BSIT</option>
                    <option value="2">BSOA</option>
                    <option value="3">BSED</option>
                    <option value="4">BEED</option>
                    <option value="5">BSCRIM</option>
                    <option value="6">BSTM</option>
                </select> <br>
                <!-- <input list="dept1" name="dept" id="dept">
                <datalist id="dept1">
                    <option value="BSIT">
                    <option value="BSOA">
                    <option value="BSED">
                    <option value="BEED">
                    <option value="BSCRIM">
                    <option value="BSTM">
                </datalist> <br> -->
                <label>Position:</label>
                <select name="position_id" id="position_id" required>
                <option selected disabled value="<?php echo $position_desc ;?>"><?php echo $position_desc ;?></option>
                    <optgroup label="-Select New-"></optgroup>
                    <option value="1">Dept. Head</option>
                    <option value="2">Teacher</option>
                    <option value="3">Office Staff</option>
                    <option value="4">Secretary</option>
                    <option value="5">Utility</option>
                </select><br>

                <button disabled type="submit" name="setDepartment">Save</button>
                <button type="submit" name="updateDept" id="updateDept" onclick="undisableTxt2()">Update</button>
                <!-- <button type="submit" name="deleteDept" id="deleteDept">Delete</button> -->

        </form>

            <br><br>   <hr>   <br><br>      

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
                    </tr>
                    <?php }} ?>
                </tbody>
            </table>

    <?php
         
                            }       
    }  
    
        if($activeForm){  // this is the first form that first display before search E_ID
    ?>
    <!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------  -->
        <form action="../user_interface/UI_setDepartment.php" method="post">
            <div>
                <label>Search For Employee E_ID:</label>
                <input type="number" name="srch" id="srch" >
                <button type="submit" name="srch1" id="srch1">-></button>
            </div>
        </form>

        <form action="" method="post">

                <label>E_ID:</label>
                <input type="number" name="E_ID" id="E_ID" ><br>
                <label>First Name:</label>
                <input type="text" name="fname" id="fname" ><br>
                <label>Last Name:</label>
                <input type="text" name="lname" id="lname" ><br>
                <label>Email:</label>
                <input type="email" name="email" id="email" ><br>
                <label>Contact:</label>
                <input type="number" name="contact" id="contact" ><br>
                <label>Employee Dept:</label>
                <select name="dept" id="dept" required>
                    <option selected disabled value="">- Select -</option>
                    <option value="1">BSIT</option>
                    <option value="2">BSOA</option>
                    <option value="3">BSED</option>
                    <option value="4">BEED</option>
                    <option value="5">BSCRIM</option>
                    <option value="6">BSTM</option>
                </select> <br>
                <!-- <input list="dept1" name="dept" id="dept">
                <datalist id="dept1">
                    <option value="BSIT">
                    <option value="BSOA">
                    <option value="BSED">
                    <option value="BEED">
                    <option value="BSCRIM">
                    <option value="BSTM">
                </datalist> <br> -->
                <label>Position:</label>
                <select name="position" id="position" required>
                    <option selected disabled value="">- Select -</option>
                    <option value="1">Dept. Head</option>
                    <option value="2">Teacher</option>
                    <option value="3">Office Staff</option>
                    <option value="4">Secretary</option>
                    <option value="5">Utility</option>
                </select><br>

            <div>
                <button disabled type="submit" name="setDepartment">Save</button>
                <button disabled="disabled">Update</button>
            </div>

        </form>

            <br><br>   <hr>   <br><br>      

<!------------------------------------------ TABLE BELOW IS FOR SHOWING DATA FROM DATABASE (tbl_employee_department_position) ---------------------------------------->

        <div>
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
                    </tr>
                    <?php }} ?>
                </tbody>
            </table>
        </div>   
    <?php } ?> 
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