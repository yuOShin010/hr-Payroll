<?php
    // session_start();
    // require_once('../operator/UI_payroll.php');
    

class payroll_manage extends MyPayroll {

    // ------------------------------------------------- PAYROLL SAVE BTN ACTIVE ------------------------------------------------- // 
        public function active_save_payroll(){
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
                <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
                <link rel="stylesheet" href="../css/dashboard.css">
                <link rel="stylesheet" href="../css/proper-placement.css">
                <link rel="stylesheet" href="../css/default.css">
            </head>
            <body>
            <?php
            require_once('../php/classes/payrollClass.php');
            $pdo = $this->openConnection();  
            $search_Eid = $_POST['search_E_ID'];
        
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
            $stmt->execute([$search_Eid]);

            if($stmt->rowCount() > 0){
            
                foreach ($stmt as $row) {

                    $E_ID = $row['employee_id'];
                    $fname = $row['first_name'];
                    $lname = $row['last_name'];
                    // $email = $row['email'];
                    $contact = $row['contact'];
                    // For Updating data Below Credentials    
                    $dept_id = $row['dept_id'];
                    $dept_code = $row['dept_code'];
                    // For updating Credentials
                    $total_workHrs = $row['total_workHrs'];
                    $d_from = $row['d_from'];
                    $d_to = $row['d_to'];
                    $days_works = $row['days_works'];
                } 
            }   ?>

                    <div class="container-small">
                        <form action="UI_payroll.php" method="post">
                            <!-- form search-->
                            <div class="search-bg">
                                <div class="search">
                                    <input class="input-style search-style" placeholder="Search Employee ID" type="number" name="search_E_ID" id="search_E_ID">
                                    <button type="submit" name="search" id="search_e"><i class='bx bx-search bx-margin'></i></button>
                                </div>
                            </div>
                        </form>

                        <!-- form -->
                        <form action="../php/process.php" method="POST">
                            <h3>Result:</h3>
                            <label>
                                <input class="input-style" type="number" name="E_ID" id="E_ID" required readonly value="<?php echo $E_ID ?>">
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
                            <label>
                                <input class="input-style removearrow" type="number" name="contact" id="contact" required readonly value="<?php echo $contact ?>">
                                <p>Contact</p>
                            </label>
                            <label>
                                <select class="sel-size" name="dept_id" id="dept_id" required>
                                    <option selected hidden value="<?php echo $dept_id ?>"><?php echo $dept_code ?></option>
                                </select>
                                <p>Employee Department</p>
                            </label>
                            <label>
                                <input class="input-style removearrow" type="number" name="hours_work" id="hours_work" required readonly value="<?php echo $total_workHrs ?>">
                                <p>Hours Work</p>
                            </label>
                            <label>
                                <input class="input-style removearrow" type="date" name="d_from" id="d_from" required readonly value="<?php echo $d_from ?>">
                                <p>Date From</p>
                            </label>
                            <label>
                                <input class="input-style removearrow" type="date" name="d_to" id="d_to" required readonly value="<?php echo $d_to ?>">
                                <p>Date To</p>
                            </label>
                            <label>
                                <input class="input-style" type="number" name="days_work" id="days_work" required readonly value="<?php echo $days_works ?>">
                                <p>Days Work</p>
                            </label>
                            <br>
                            <br>
                        </div>
                        <section class="banner2"></section> <!--this is the banner -->
                        <div class="container-sSmall2">
                            <h3>Please Fill Up this field: </h3>
                            <label class="b1">
                                <input class="b-size" type="number" name="overtime" id="overtime" step="any" value="0" required placeholder="0">
                                <p>Over Time</p>
                            </label>
                            <label class="b2">
                                <input class="b-size" type="number" name="allowance" id="allowance" step="any" value="0" required placeholder="0">
                                <p>Allowance</p>
                            </label>
                            <label class="b3">
                                <input class="b-size" type="number" name="holidays_work" id="holidays_work" value="0" required placeholder="0">
                                <p>Holidays Work</p>
                            </label>
                            <label class="b4">
                                <input class="b-size" type="number" name="leave_days" id="leave_days" value="0" required placeholder="0">
                                <p>Leave Days</p>
                            </label>
                            <label class="b5">
                                <input class="b-size" type="number" name="sss" id="sss" step="any" value="0" required placeholder="0">
                                <p>SSS</p>
                            </label>
                            <label class="b5">
                                <input class="b-size" type="number" name="tax" id="tax" step="any" value="0" required placeholder="0">
                                <p>TAX</p>
                            </label>
                            <label class="b6">
                                <input class="b-size" type="number" name="pag_ibig" id="pag_ibig" step="any" value="0" required placeholder="0">
                                <p>Pag-ibig</p>
                            </label>
                            <label class="b7">
                                <input class="b-size" type="number" name="phil_health" id="phil_health" step="any" value="0" required placeholder="0">
                                <p>Phil-Health</p>
                            </label>
                            <label class="b8">
                                <input class="b-size" type="number" name="sss_loan" id="sss_loan" step="any" value="0" required placeholder="0">
                                <p>SSS-Loan</p>
                            </label>
                            <label class="b8">
                                <input class="b-size" type="number" name="tax_loan" id="tax_loan" step="any" value="0" required placeholder="0">
                                <p>TAX-Loan</p>
                            </label>
                            <label class="b9">
                                <input class="b-size" type="number" name="pag_ibig_loan" id="pag_ibig_loan" step="any" value="0" required placeholder="0">
                                <p>Pag-ibig loan</p>
                            </label>
                            <label class="b10">
                                <input class="b-size" type="number" name="phil_health_loan" id="phil_health_loan" step="any" value="0" required placeholder="0">
                                <p>Phil-Health Loan</p>
                            </label>
                            <label class="b11">
                                <input class="b-size" type="text" name="others" id="others" step="any" value="0" required placeholder="0">
                                <p>Others</p>
                            </label>
                            <label>
                                <input class="go-btn" type="button" onclick="deductions_computation()">
                            </label>
                            <label class="b12">Deduction Total:
                                <input class="b-size" type="number" name="total_deductions" id="total_deductions" step="any" required readonly>
                            </label>

                            <button class="button save" type="submit" name="addPayroll">Save</button>
                            <button class="button" disabled>Update</button>
                            <button class="button" disabled>Delete</button>
                        </div>
                    </form>

                        <section class="banner2"></section> <!--this is the banner -->

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
                                    // $pdo = $classPayroll->openConnection();
                                    $sql = "SELECT
                                    A.id,
                                    B.employee_id, B.isActive, B.first_name, B.last_name, B.email, B.contact,
                                    C.dept_id, C.dept_code,
                                    E.total_workHrs, E.d_from, E.d_to, E.days_works,
                                    F.overtime, F.allowance, F.holidays_work, F.leave_days, F.sss, F.tax, F.pag_ibig, F.phil_health,
                                    F.sss_loan, F.tax_loan, F.pag_ibig_loan, F.phil_health_loan, F.others, F.total_deduction
                                    FROM tbl_employee_payroll AS A
                                    LEFT JOIN employee AS B
                                    ON A.employee_id = B.employee_id
                                    LEFT JOIN department AS C
                                    ON A.dept_id = C.dept_id
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

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <script>

                    function deductions_computation(){
                        var sss = parseFloat($("#sss").val());
                        var tax = parseFloat($("#tax").val());
                        var pag_ibig = parseFloat($("#pag_ibig").val());
                        var phil_health = parseFloat($("#phil_health").val());
                        var sss_loan = parseFloat($("#sss_loan").val());
                        var tax_loan = parseFloat($("#tax_loan").val());
                        var pag_ibig_loan = parseFloat($("#pag_ibig_loan").val());
                        var phil_health_loan = parseFloat($("#phil_health_loan").val());
                        var others = parseFloat($("#others").val());

                        var total_deductions = sss + tax + pag_ibig + phil_health + sss_loan + tax_loan + pag_ibig_loan + phil_health_loan + others;

                        $("#total_deductions").val(total_deductions);
                    }

                </script>
                </body>
                </html>
            <?php
        }

    // ------------------------------------------------- PAYROLL UPDATE BTN ACTIVE ------------------------------------------------- // 

        public function active_update_payroll(){

            require_once('../php/classes/payrollClass.php');
            $pdo = $this->openConnection(); 
            $search_EID = $_POST['search_E_ID'];

            $sql = "SELECT
            A.id,
            B.employee_id, B.isActive, B.first_name, B.last_name, B.email, B.contact,
            C.dept_id, C.dept_code,
            E.total_workHrs, E.d_from, E.d_to, E.days_works,
            F.overtime, F.allowance, F.holidays_work, F.leave_days, F.sss, F.tax, F.pag_ibig, F.phil_health,
            F.sss_loan, F.tax_loan, F.pag_ibig_loan, F.phil_health_loan, F.others, F.total_deduction
            FROM tbl_employee_payroll AS A
            LEFT JOIN employee AS B
            ON A.employee_id = B.employee_id
            LEFT JOIN department AS C
            ON A.dept_id = C.dept_id
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
                    // $email = $row['email'];
                    $contact = $row['contact'];
                    $dept_id = $row['dept_id'];
                    $dept_code = $row['dept_code'];
                    // $position_id = $row['position_id'];
                    // $position_desc = $row['position_desc'];
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
                    $sss = $row['sss'];
                    $tax = $row['tax'];
                    $pag_ibig = $row['pag_ibig'];
                    $phil_health = $row['phil_health'];
                    $sss_loan = $row['sss_loan'];
                    $tax_loan = $row['tax_loan'];
                    $pag_ibig_loan = $row['pag_ibig_loan'];
                    $phil_health_loan = $row['phil_health_loan'];
                    $ohters = $row['others'];
                    $total_deduction = $row['total_deduction'];
                }

            }  ?>

                    <div class="container-xsmall">
                        <form action="UI_payroll.php" method="post">
                            <!-- form search-->
                            <div class="search-bg">
                                <div class="search">
                                    <input class="input-style search-style" placeholder="Search Employee ID" type="number" name="search_E_ID" id="search_E_ID">
                                    <button type="submit" name="search" id="search_e"><i class='bx bx-search bx-margin'></i></button>
                                </div>
                            </div>
                        </form>

                        <!-- form -->
                        <form action="../php/process.php" method="POST">
                            <h3>Result:</h3>
                            <label>
                                <input class="input-style" type="text" name="E_ID" id="E_ID" required readonly value="<?php echo $E_ID ?>">
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
                            <label>
                                <input class="input-style removearrow" type="number" name="contact" id="contact" required readonly value="<?php echo $contact ?>">
                                <p>Contact</p>
                            </label>
                            <label>
                                <select class="sel-size" name="dept_id" id="dept_id" required>
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
                    </div>
                    <section class="banner2"></section> <!--this is the banner -->
                    <div class="container-sSmall2">
                        <h3>Possible to update this fields:</h3>
                            <label class="b1">
                                <input class="b-size" type="number" name="overtime" id="overtime" step="any" required placeholder="0" value="<?php echo $overtime ?>">
                                <p>Over Time</p>
                            </label>
                            <label class="b2">
                                <input class="b-size" type="number" name="allowance" id="allowance" step="any" required placeholder="0" value="<?php echo $allowance ?>">
                                <p>Allowance</p>
                            </label>
                            <label class="b3">
                                <input class="b-size" type="number" name="holidays_work" id="holidays_work" step="any" required placeholder="0" value="<?php echo $holidays_work ?>">
                                <p>Holidays Work</p>
                            </label>
                            <label class="b4">
                                <input class="b-size" type="number" name="leave_days" id="leave_days" step="any" required placeholder="0" value="<?php echo $leave_days ?>">
                                <p>Leave Days</p>
                            </label>
                            <label class="b5">
                                <input class="b-size" type="number" name="sss" id="sss" step="any" required placeholder="0" value="<?php echo $sss ?>">
                                <p>SSS</p>
                            </label>
                            <label class="b5">
                                <input class="b-size" type="number" name="tax" id="tax" step="any" required placeholder="0" value="<?php echo $tax ?>">
                                <p>TAX</p>
                            </label>
                            <label class="b6">
                                <input class="b-size" type="number" name="pag_ibig" id="pag_ibig" step="any" required placeholder="0" value="<?php echo $pag_ibig ?>">
                                <p>Pag-ibig</p>
                            </label>
                            <label class="b7">
                                <input class="b-size" type="number" name="phil_health" id="phil_health" step="any" required placeholder="0" value="<?php echo $phil_health ?>">
                                <p>Phil-Health</p>
                            </label>
                            <label class="b8">
                                <input class="b-size" type="number" name="sss_loan" id="sss_loan" step="any" required placeholder="0" value="<?php echo $sss_loan ?>">
                                <p>SSS-Loan</p>
                            </label>
                            <label class="b8">
                                <input class="b-size" type="number" name="tax_loan" id="tax_loan" step="any" required placeholder="0" value="<?php echo $tax_loan ?>">
                                <p>TAX-Loan</p>
                            </label>
                            <label class="b9">
<<<<<<< HEAD
                                <input class="b-size" type="number" name="pag_ibig_loan" id="pag_ibig_loan" step="any" required placeholder="0" value="<?php echo $pag_ibig_loan ?>">
=======
                                <input class="b-size" type="number" name="pag_ibig_loan" id="pag_ibig_loan" required placeholder="0" value="<?php echo $pag_ibig_loan ?>">
>>>>>>> 1d6210f4072c6b751490b69444b2e10d76ebe25d
                                <p>Pag-ibig loan</p>
                            </label>
                            <label class="b10">
                                <input class="b-size" type="number" name="phil_health_loan" id="phil_health_loan" step="any" required placeholder="0" value="<?php echo $phil_health_loan ?>">
                                <p>Phil-Health Loan</p>
                            </label>
                            <label class="b11">
<<<<<<< HEAD
                                <input class="b-size" type="number" name="others" id="others" step="any" required placeholder="0" value="<?php echo $ohters ?>">
=======
                                <input class="b-size" type="number" name="others" id="others" required placeholder="0" value="<?php echo $ohters ?>">
>>>>>>> 1d6210f4072c6b751490b69444b2e10d76ebe25d
                                <p>Others</p>
                            </label>
                            <label>
                                <input class="go-btn" type="button" onclick="deductions_computation()">
                            </label>
                            <label class="b12">Deduction Total:
                                <input class="b-size" type="number" name="total_deductions" id="total_deductions" step="any" required value="<?php echo $total_deduction ?>">
                            </label>

                            <button class="button" disabled>Save</button>
                            <button class="button update" type="submit" name="updatePayroll">Update</button>
                            <button class="button" disabled>Delete</button>
                    </div>
                        </form>
                        <section class="banner2"></section> <!--this is the banner -->

                        <!------------------------------------------ TABLE BELOW IS FOR SHOWING DATA FROM DATABASE ---------------------------------------->
                        
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
                                    // $pdo = $this->openConnection();
                                    $sql = "SELECT
                                    A.id,
                                    B.employee_id, B.isActive, B.first_name, B.last_name, B.email, B.contact,
                                    C.dept_id, C.dept_code,
                                    E.total_workHrs, E.d_from, E.d_to, E.days_works,
                                    F.overtime, F.allowance, F.holidays_work, F.leave_days, F.sss, F.tax, F.pag_ibig, F.phil_health,
                                    F.sss_loan, F.tax_loan, F.pag_ibig_loan, F.phil_health_loan, F.others, F.total_deduction
                                    FROM tbl_employee_payroll AS A
                                    LEFT JOIN employee AS B
                                    ON A.employee_id = B.employee_id
                                    LEFT JOIN department AS C
                                    ON A.dept_id = C.dept_id
                                    LEFT JOIN schedule AS E
                                    ON A.employee_id = E.employee_id
                                    LEFT JOIN payroll AS F
                                    ON A.employee_id = F.employee_id
                                    WHERE B.isActive = 1 AND A.id > 0";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute();

                                    if ($stmt->rowCount() > 0) {
                                        foreach($stmt as $row) {
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
                        
                    

                    <script>

                    function deductions_computation(){
                        var sss = parseFloat($("#sss").val());
                        var tax = parseFloat($("#tax").val());
                        var pag_ibig = parseFloat($("#pag_ibig").val());
                        var phil_health = parseFloat($("#phil_health").val());
                        var sss_loan = parseFloat($("#sss_loan").val());
                        var tax_loan = parseFloat($("#tax_loan").val());
                        var pag_ibig_loan = parseFloat($("#pag_ibig_loan").val());
                        var phil_health_loan = parseFloat($("#phil_health_loan").val());
                        var others = parseFloat($("#others").val());

                        var total_deductions = sss + tax + pag_ibig + phil_health + sss_loan + tax_loan + pag_ibig_loan + phil_health_loan + others;

                        $("#total_deductions").val(total_deductions);
                    }

                </script>
            <?php
        }

    }

    $payroll_manage_class = new payroll_manage();



?>