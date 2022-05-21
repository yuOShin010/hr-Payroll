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
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/default.css">
    <title>Schedule Management</title>
    <style>
        .weeklyCut, .halfMonthCut{
            display: none;
        }
    </style>

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
                
                <li> <a href="../operator/UI_addEmployee.php">Employee Management</a></li>
                <li> <a href="../operator/UI_setDepartment.php">Department Management</a></li>
                <li> <a href="../operator/UI_schedule.php">Scheduling Management</a></li>
                <li> <a href="../operator/UI_payroll.php">Payroll Management</a></li>
                <li> <a href="../operator/UI_employeeSalary.php">Employee Salary Report</a></li>
                <li> <a href="../operator/UI_payslipReport.php">Payslip Report/Print</a></li>
                <li> <a href="../operator/UI_companyReport.php">Company Report</a></li>
            </ul>
           
        </div>
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
            <!-- <form action="../php/process.php" method="post"> --> 
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
                    
        <input type="radio" name="cut" value="weekly" id="weekly" onchange="radioget($(this).val())">Weekly
        <input type="radio" name="cut" value="halfMonth" id="monthly" onchange="radioget($(this).val())">half A Month
        <!-- <button type="submit" name="btnCut">**</button> --> 
        <input type="hidden" id="selvalue">
        <br>
        <label id="selvalue1"></label>
        </br> 
        

        <!-- Weekly  -->
        <div class="cutsWrappper weeklyCut">
            <label>DATE FROM:</label>
            <input type="date" name="from" id="dateFrom" style="margin-bottom: 10px;">
            <br>
            <label>DATE TO:</label>    
            <input type="date" name="to" id="dateTo" readonly>
            <button onclick="dateManipulateWeek()">**</button>   <!-- Button Here -->
            <hr>
            <label><input type="checkbox" name="sun" id="sun"> <span> SUN </span> </label>   <input type="time" name="" id="T_I1" style="margin-left: 10px;">   <input type="time" name="" id="T_O1">   <br>
            <label><input type="checkbox" name="mon" id="mon"> <span> MON </span> </label>   <input type="time" name="" id="T_I2" style="margin-left: 10px;">   <input type="time" name="" id="T_O2">   <br>
            <label><input type="checkbox" name="tue" id="tue"> <span> TUE </span> </label>   <input type="time" name="" id="T_I3" style="margin-left: 10px;">   <input type="time" name="" id="T_O3">   <br>
            <label><input type="checkbox" name="wed" id="wed"> <span> WED </span> </label>   <input type="time" name="" id="T_I4" style="margin-left: 10px;">   <input type="time" name="" id="T_O4">   <button onclick="set_allTime()">**</button>   <br>
            <label><input type="checkbox" name="thu" id="thu"> <span> THU </span> </label>   <input type="time" name="" id="T_I5" style="margin-left: 10px;">   <input type="time" name="" id="T_O5">   <br>
            <label><input type="checkbox" name="fri" id="fri"> <span> FRI </span> </label>   <input type="time" name="" id="T_I6" style="margin-left: 10px;">   <input type="time" name="" id="T_O6">   <br>
            <label><input type="checkbox" name="sat" id="sat"> <span> SAT </span> </label>   <input type="time" name="" id="T_I7" style="margin-left: 10px;">   <input type="time" name="" id="T_O7">   <br>
        </div>
        <!-- Monthly -->
        <div class="cutsWrappper halfMonthCut">
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
        </div>
    <br>
    <hr>
    <br>    
                <button type="submit" id="submitSchedule" name="set_schedule">Save</button> 
                <button disabled type="submit " name="updateDept" id="updateDept">Update</button>
            </div>
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

        
        <input type="radio" name="cut" value="weekly">Weekly
        <input type="radio" name="cut" value="halfMonth">half A Month
        <!-- <button type="submit" name="btnCut">**</button> --> 
        <input type="hidden" id="selvalue">
        <br>
        <label id="selvalue1"></label>
    <br>
    <hr>
    <br> 

                <div class="cutsWrappper weeklyCut">
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
                </div>
                <div class="cutsWrappper halfMonthCut">
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
                </div>

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

    <script>
        $("[name=cut]").change(function(){
            if($(this).val() == "weekly"){
                $(".halfMonthCut").hide();
                $(".weeklyCut").show();
            }if($(this).val() == "halfMonth"){
                $(".weeklyCut").hide();
                $(".halfMonthCut").show();
            }
        });
        $("#submitSchedule").click(function(){
            var id = $("#E_ID1").val();
            var fname= $("#fname1").val();
            var lname= $("#lname1").val();
            var email= $("#email1").val();
            var contact= $("#contact1").val();
            var deptID= $("#dept_id").val();
            var positionID= $("#position_id").val();
            var weekly= $("#weekly").val();
            var monthly= $("#monthly").val();

            var sun= $("#sun").val();
            var mon= $("#mon").val();
            var tue= $("#tue").val();
            var wed= $("#wed").val();
            var thu= $("#thu").val();
            var fri= $("#fri").val();
            var sat= $("#sat").val();
            // Timein
            var t_i1= $("#T_I1").val();
            var t_i2= $("#T_I2").val();
            var t_i3= $("#T_I3").val();
            var t_i4= $("#T_I4").val();
            var t_i5= $("#T_I5").val();
            var t_i6= $("#T_I6").val();
            var t_i7= $("#T_I7").val();
            // timeout
            var t_o1= $("#T_O1").val();
            var t_o2= $("#T_O2").val();
            var t_o3= $("#T_O3").val();
            var t_o4= $("#T_O4").val();
            var t_o5= $("#T_O5").val();
            var t_o6= $("#T_O6").val();
            var t_o7= $("#T_O7").val();

            
            // alert(id);
           $.post({
                url : "../php/process.php",
                data : {
                    submit : 1,
                    id : id ,
                    fname : fname,
                    lname : lname,
                    email : email,
                    contact : contact,
                    deptID : deptID,
                    positionID :positionID,
                    weekly :weekly,
                    monthly :monthly,

                    sun :sun,
                    mon :mon,
                    tue :tue,
                    wed :wed,
                    thu :thu,
                    fri :fri,
                    sat :sat,
                    t_i1 :t_i1,
                    t_i2 :t_i2,
                    t_i3 :t_i3,
                    t_i4 :t_i4,
                    t_i5 :t_i5,
                    t_i6 :t_i6,
                    t_i7 :t_i7,
                    t_o1 :t_o1,
                    t_o2 :t_o2,
                    t_o3 :t_o3,
                    t_o4 :t_o4,
                    t_o5 :t_o5,
                    t_o6 :t_o6,
                    t_o7 :t_o7,

                }, success : function(data){
                    console.log(data);
                }, error : function (data){
                    console.log(data);
                }
           });
        });
    </script>

    <script>

    function radioget(getValue){
        document.getElementById('selvalue').value=getValue;
        document.getElementById('selvalue1').innerHTML=getValue;
    }

    // $(document).ready(function(){
    //     $('input[type="radio"]').click(function(){
    //         var btnCut = $(this).val();

    //         $.ajax({
    //             url:"UI_schedule.php",
    //             method:"POST",
    //             data:{btnCut:btnCut},
    //             success:function(data){
    //                 $('#selvalue').val(data);
    //             }

    //         });
            
    //     });

    // });

    </script>

    <script>

      function dateManipulateWeek (){   // For show day add (weekly) 
        first = new Date($('#dateFrom').val());
        // console.log(first);
        output = new Date(first.setDate(first.getDate()+6)).toISOString().split('.');
        output7 = output[0].split('T');
        $('#dateTo').val(output7[0]);   // show to date to automatic
         // show data in checkbox
      }

      function dateManipulateMonth (){   // For show day add (Half Month)
        first = new Date($('#dateFrom').val());
        // console.log(first);
        output = new Date(first.setDate(first.getDate()+14)).toISOString().split('.');
        output7 = output[0].split('T');
        $('#dateTo').val(output7[0]);   // show to date to automatic
         // show data in checkbox
      }

      function set_allTime(){   // for set all same time in time out
        const timeIN = document.getElementById('T_I1').value;
        const timeOUT = document.getElementById('T_O1').value;

        // Time in set all
        document.getElementById('T_I2').value=timeIN;
        document.getElementById('T_I3').value=timeIN;
        document.getElementById('T_I4').value=timeIN;
        document.getElementById('T_I5').value=timeIN;
        document.getElementById('T_I6').value=timeIN;
        document.getElementById('T_I7').value=timeIN;
        // time out set all
        document.getElementById('T_O2').value=timeOUT;
        document.getElementById('T_O3').value=timeOUT;
        document.getElementById('T_O4').value=timeOUT;
        document.getElementById('T_O5').value=timeOUT;
        document.getElementById('T_O6').value=timeOUT;
        document.getElementById('T_O7').value=timeOUT;
      }

    //   $('#dateFrom').datepicker({ minDate: 4,beforeShowDay: $.datepicker.noWeekends });

      

  </script>

</body>
</html>