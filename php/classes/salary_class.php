<?php

class salary_report extends MyPayroll {
    // --------------------------------------------------------- SALARY SAVE BTN ACTIVE --------------------------------------------------------- //

        public function active_save_salary(){ ?>

                    <div class="banner">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 back-btn" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                                <path strokeLinecap="round" strokeLinejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                        </div>

                    <div class="container-large">
                        <form action="UI_employeeSalary.php" method="post">
                            <!-- form search-->
                            <div class="search-bg">
                                <div class="search">
                                    <input class="input-style search-style" placeholder="Search Employee ID" type="number" name="search_E_ID" id="search_E_ID">
                                    <button type="submit" name="search" id="search_e"><i class='bx bx-search bx-margin'></i></button>
                                </div>
                            </div>
                        </form>

                        <label>
                        <input class="input-style inpt-pl20" type="number" name="E_ID" id="E_ID" required readonly> 
                        <p>Employee ID</p>
                        </label>
                        <label>
                            <input class="input-style inpt-pl20" type="text" name="fname" id="fname" required readonly>
                            <p>First Name</p>
                        </label>
                        <label>
                            <input class="input-style inpt-pl20" type="text" name="lname" id="lname" required readonly>
                            <p>Last Name</p>
                        </label>
                        <label>
                            <input class="input-style inpt-pl20 removearrow" type="number" name="contact" id="contact" required readonly>
                            <p>Contact</p>
                        </label>
                        
                        <label>
                            <input class="input-style inpt-pl20 removearrow" type="number" name="dept_code" id="dept_code" required readonly>
                            <p>Employee Department</p>
                        </label>
                        <label>
                            <input class="input-style inpt-pl20 removearrow" type="number" name="position_desc" id="position_desc" required readonly>
                            <p>Position</p>
                        </label>
                        <br>

                        <label>
                            <input class="input-style inpt-pl20" type="number" name="ot" id="ot" step="any" required readonly>
                            <p>Overtime</p>
                        </label>
                        <label>
                            <input class="input-style inpt-pl20" type="number" name="holidays_work" id="holidays_work" required readonly>
                            <p>Holidays Works</p>
                        </label>
                        <label>
                            <input class="input-style inpt-pl20" type="number" name="allowance" id="allowance" step="any" required readonly>
                            <p>Allowance</p>
                        </label>
                        <label>
                            <input class="input-style inpt-pl20" type="number" name="hours_work" id="hours_work" required readonly>
                            <p>Work Hours</p>
                        </label>
                        <label>
                            <input class="input-style inpt-pl20" type="number" name="days_work" id="days_work" required readonly>
                            <p>Days Work</p>
                        </label>
                        <label>
                            <input class="input-style inpt-pl20" type="number" name="leave_day" id="leave_day" required readonly>
                            <p>Leave Days</p>
                        </label>
                        <br>
                        <h3>Start Here ..</h3>
                        <!-- Pay -->
                        <label>
                            <input class="input-style inpt-pl20" type="number" name="days_work_pay" id="days_work_pay" step="any" required readonly>
                            <p>Days Work Pay</p>
                        </label>
                        <label>
                            <input class="input-style inpt-pl20" type="number" name="total_hrs_pay" id="total_hrs_pay" step="any" required readonly>
                            <p>Total Hours Pay</p>
                        </label>
                        <label>
                            <input class="input-style inpt-pl20" type="number" name="ot_pay" id="ot_pay" step="any" required readonly>
                            <p>Over Time Pay</p>
                        </label>
                        <label>
                            <input class="input-style inpt-pl20" type="number" name="holidays_pay" id="holidays_pay" step="any" required readonly>
                            <p>Holidays Pay</p>
                        </label>
                        <label>
                            <input class="input-style inpt-pl20" type="number" name="leave_pay" id="leave_pay" step="any" required readonly>
                            <p>Leave Days Pay</p>
                        </label>
                        <label>
                            <input class="input-style inpt-pl20" type="number" name="allowance_pay" id="allowance_pay" step="any" required readonly>
                            <p>Allowance Pay</p>
                        </label>
                        <label>
                            <input class="input-style inpt-pl20" type="number" name="basic_pay" id="basic_pay" step="any" required readonly>
                            <p>Bacis Pay</p>
                        </label>
                        <br><br>
                        
                        <label>
                            <input class="b-size" type="button"  name="regular" id="regular" step="any" required>
                            <p>Regular</p>
                        </label>
                        <label>
                            <input class="b-size" type="button" name="contructual" id="contructual" step="any" required>
                            <p>Contructual</p>
                        </label>
                        <br><br>
                            <label>
                                <input class="int-red" type="number" name="total_deduction" id="total_deduction" step="any" required>
                                <p>Deduction Total</p>
                            </label>
                            <label>
                                <input class="int-green" type="number" name="net_pay" id="net_pay" step="any" required>
                                <p>NetPay</p>
                            </label>
                            <button class="button" disabled>Save</button>
                            <button class="button" name="update_salary">Update</button>
                            <!-- <button class="button" disabled>Delete</button> -->
                    </div>



                <section class="banner2"><h2>Database Table</h2></section> <!--this is the banner -->
                <!-- ________________________________DATABASE TABLE_______________________________ -->
                <div class="output">
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>E_ID</th>
                                <th>First_Name</th>
                                <th>Last_Name</th>
                                <th>Contact</th>
                                <th>Dept</th>
                                <th>Position</th>
                                <th>Days_work Pay</th>
                                <th>Total_wrkHrs Pay</th>
                                <th>O.T Pay</th>
                                <th>Hlldy_wrk Pay</th>
                                <th>Leave Pay</th>
                                <th>Allwnce_Pay</th>
                                <th>Basic_Pay</th>
                                <th>Deductions</th>
                                <th>Net_Pay</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $pdo = $this->openConnection();
                            $sql = "SELECT
                            A.id,
                            B.employee_id, B.isActive, B.first_name, B.last_name, B.contact,
                            C.dept_id, C.dept_code,
                            D.position_desc,
                            E.total_workHrs, E.d_from, E.d_to, E.days_works,
                            F.overtime, F.allowance, F.holidays_work, F.leave_days, F.sss, F.tax, F.pag_ibig, F.phil_health,
                            F.sss_loan, F.tax_loan, F.pag_ibig_loan, F.phil_health_loan, F.others, F.total_deduction,
                            G.days_work_pay, G.hours_pay, G.ot_pay, G.holidays_pay, G.leave_days_pay, G.allowance_pay, G.basic_pay, G.net_pay
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
                            WHERE B.isActive = 1 AND A.id > 0";

                            $stmt = $pdo->prepare($sql);
                            $stmt->execute();


                            if ($stmt->rowCount() > 0) {
                                foreach ($stmt as $row) {
                            ?>
                                <tr>
                                    <td><?php echo $row['employee_id']; ?></td>
                                    <td><?php echo $row['first_name']; ?></td>
                                    <td><?php echo $row['last_name']; ?></td>
                                    <td><?php echo $row['contact']; ?></td>
                                    <td><?php echo $row['dept_code']; ?></td>
                                    <td><?php echo $row['position_desc']; ?></td>
                                    <td><?php echo $row['days_work_pay']; ?></td>
                                    <td><?php echo $row['hours_pay']; ?></td>
                                    <td><?php echo $row['ot_pay']; ?></td>
                                    <td><?php echo $row['holidays_pay']; ?></td>
                                    <td><?php echo $row['leave_days_pay']; ?></td>
                                    <td><?php echo $row['allowance_pay']; ?></td>
                                    <td><?php echo $row['basic_pay']; ?></td>
                                    <td><?php echo $row['total_deduction']; ?></td>
                                    <td><?php echo $row['net_pay']; ?></td>
                                </tr>
                            <?php }} ?>
                        </tbody>
                    </table>
                </div>
            <?php
        }

    // --------------------------------------------------------- SALARY UPDATE BTN ACTIVE --------------------------------------------------------- //

        public function active_update_salary(){
            $pdo = $this->openConnection();
            $search_EID = $_POST['search_E_ID'];

            $sql = "SELECT
            A.id,
            B.employee_id, B.isActive, B.first_name, B.last_name, B.contact,
            C.dept_id, C.dept_code,
            D.position_desc,
            E.total_workHrs, E.d_from, E.d_to, E.days_works,
            F.overtime, F.allowance, F.holidays_work, F.leave_days, F.sss, F.tax, F.pag_ibig, F.phil_health,
            F.sss_loan, F.tax_loan, F.pag_ibig_loan, F.phil_health_loan, F.others, F.total_deduction,
            G.days_work_pay, G.hours_pay, G.ot_pay, G.holidays_pay, G.leave_days_pay, G.allowance_pay, G.basic_pay, G.net_pay
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

            if($stmt->rowCount() > 0){

                while($row = $stmt->fetch()){
                    $E_ID = $row['employee_id'];
                    $fname = $row['first_name'];
                    $lname = $row['last_name'];
                    $contact = $row['contact'];
                    // $dept_id = $row['dept_id'];
                    $dept_code = $row['dept_code'];
                    // $position_id = $row['position_id'];
                    $position_desc = $row['position_desc'];
                    $total_workHrs = $row['total_workHrs'];
                    // $d_from = $row['d_from'];
                    // $d_to = $row['d_to'];
                    $days_works = $row['days_works'];
                    // for update credential
                    $overtime = $row['overtime'];
                    $allowance = $row['allowance'];
                    $holidays_work = $row['holidays_work'];
                    $leave_days = $row['leave_days'];
                    // Deductions Below
                    $total_deduction = $row['total_deduction'];
                    // pay
                    $days_work_pay = $row['days_work_pay'];
                    $hours_pay = $row['hours_pay'];
                    $ot_pay = $row['ot_pay'];
                    $holidays_pay = $row['holidays_pay'];
                    $leave_days_pay = $row['leave_days_pay'];
                    $allowance_pay = $row['allowance_pay'];
                    $basic_pay = $row['basic_pay'];
                    $net_pay = $row['net_pay'];
                    
                }
            } 
              ?>
                <div class="banner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 back-btn" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                        <path strokeLinecap="round" strokeLinejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </div>

                <div class="container-large">
                    <form action="UI_employeeSalary.php" method="post">
                        <!-- form search-->
                        <div class="search-bg">
                            <div class="search">
                                <input class="input-style search-style" placeholder="Search Employee ID" type="number" name="search_E_ID" id="search_E_ID">
                                <button type="submit" name="search" id="search_e"><i class='bx bx-search bx-margin'></i></button>
                            </div>
                        </div>
                    </form>

                        <label>
                            <input class="input-style inpt-pl20" type="number" name="E_ID" id="E_ID" required readonly value="<?php echo $E_ID; ?>"> 
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
                            <input class="input-style inpt-pl20 removearrow" type="number" name="dept_code" id="dept_code" required readonly value="<?php echo $dept_code; ?>">
                            <p>Employee Department</p>
                        </label>
                        <label>
                            <input class="input-style inpt-pl20 removearrow" type="number" name="position_desc" id="position_desc" required readonly value="<?php echo $position_desc; ?>">
                            <p>Position</p>
                        </label>
                        <br>

                        <label>
                            <input class="input-style inpt-pl20" type="number" name="ot" id="ot" step="any" required readonly value="<?php echo $overtime; ?>">
                            <p>Overtime</p>
                        </label>
                        <label>
                            <input class="input-style inpt-pl20" type="number" name="holidays_work" id="holidays_work" required readonly value="<?php echo $holidays_work; ?>">
                            <p>Holidays Works</p>
                        </label>
                        <label>
                            <input class="input-style inpt-pl20" type="number" name="allowance" id="allowance" step="any" required readonly value="<?php echo $allowance; ?>">
                            <p>Allowance</p>
                        </label>
                        <label>
                            <input class="input-style inpt-pl20" type="number" name="hours_work" id="hours_work" required readonly value="<?php echo $total_workHrs; ?>">
                            <p>Work Hours</p>
                        </label>
                        <label>
                            <input class="input-style inpt-pl20" type="number" name="days_work" id="days_work" required readonly value="<?php echo $days_works; ?>">
                            <p>Days Work</p>
                        </label>
                        <label>
                            <input class="input-style inpt-pl20" type="number" name="leave_day" id="leave_day" required readonly value="<?php echo $leave_days; ?>">
                            <p>Leave Days</p>
                        </label>
                        <br>
                        <h3>Start Here ..</h3>
                        <!-- Pay -->
                        <label>
                            <input class="input-style inpt-pl20" type="number" name="days_work_pay" id="days_work_pay" step="any" required readonly value="<?php echo $days_work_pay; ?>">
                            <p>Days Work Pay</p>
                        </label>
                        <label>
                            <input class="input-style inpt-pl20" type="number" name="total_hrs_pay" id="total_hrs_pay" step="any" required readonly value="<?php echo $hours_pay; ?>">
                            <p>Total Hours Pay</p>
                        </label>
                        <label>
                            <input class="input-style inpt-pl20" type="number" name="ot_pay" id="ot_pay" step="any" required readonly value="<?php echo $ot_pay; ?>">
                            <p>Over Time Pay</p>
                        </label>
                        <label>
                            <input class="input-style inpt-pl20" type="number" name="holidays_pay" id="holidays_pay" step="any" required readonly value="<?php echo $holidays_pay; ?>">
                            <p>Holidays Pay</p>
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
                            <input class="input-style inpt-pl20" type="number" name="basic_pay" id="basic_pay" step="any" required readonly value="<?php echo $basic_pay; ?>">
                            <p>Bacis Pay</p>
                        </label>
                        <br><br>
                        
                        <label>
                            <input class="b-size" type="button"  name="regular" id="regular">
                            <p>Regular</p>
                        </label>
                        <label>
                            <input class="b-size" type="button" name="contructual" id="contructual">
                            <p>Contructual</p>
                        </label>
                        <br><br>
                            <label>
                                <input class="int-red" type="number" name="total_deduction" id="total_deduction" step="any" required value="<?php echo $total_deduction; ?>">
                                <p>Deduction Total</p>
                            </label>
                            <label>
                                <input class="int-green" type="number" name="net_pay" id="net_pay" step="any" required value="<?php echo $net_pay; ?>">
                                <p>NetPay</p>
                            </label>
                            <button class="button" disabled>Save</button>
                            <button class="button" name="update_salary">Update</button>
                            <!-- <button class="button" disabled>Delete</button> -->
                </div>



                <section class="banner2"><h2>Database Table</h2></section> <!--this is the banner -->
                <!-- ________________________________DATABASE TABLE_______________________________ -->
                <div class="output">
                        <table class="table table-dark table-striped">
                            <thead>
                                <tr>
                                    <th>E_ID</th>
                                    <th>First_Name</th>
                                    <th>Last_Name</th>
                                    <th>Contact</th>
                                    <th>Dept</th>
                                    <th>Position</th>
                                    <th>Days_work Pay</th>
                                    <th>Total_wrkHrs Pay</th>
                                    <th>O.T Pay</th>
                                    <th>Hlldy_wrk Pay</th>
                                    <th>Leave Pay</th>
                                    <th>Allwnce_Pay</th>
                                    <th>Basic_Pay</th>
                                    <th>Deductions</th>
                                    <th>Net_Pay</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $pdo = $this->openConnection();
                                $sql = "SELECT
                                A.id,
                                B.employee_id, B.isActive, B.first_name, B.last_name, B.contact,
                                C.dept_id, C.dept_code,
                                D.position_desc,
                                E.total_workHrs, E.d_from, E.d_to, E.days_works,
                                F.overtime, F.allowance, F.holidays_work, F.leave_days, F.sss, F.tax, F.pag_ibig, F.phil_health,
                                F.sss_loan, F.tax_loan, F.pag_ibig_loan, F.phil_health_loan, F.others, F.total_deduction,
                                G.days_work_pay, G.hours_pay, G.ot_pay, G.holidays_pay, G.leave_days_pay, G.allowance_pay, G.basic_pay, G.net_pay
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
                                WHERE B.isActive = 1 AND A.id > 0";

                                $stmt = $pdo->prepare($sql);
                                $stmt->execute();


                                if ($stmt->rowCount() > 0) {
                                    foreach ($stmt as $row) {
                                ?>
                                    <tr>
                                        <td><?php echo $row['employee_id']; ?></td>
                                        <td><?php echo $row['first_name']; ?></td>
                                        <td><?php echo $row['last_name']; ?></td>
                                        <td><?php echo $row['contact']; ?></td>
                                        <td><?php echo $row['dept_code']; ?></td>
                                        <td><?php echo $row['position_desc']; ?></td>
                                        <td><?php echo $row['days_work_pay']; ?></td>
                                        <td><?php echo $row['hours_pay']; ?></td>
                                        <td><?php echo $row['ot_pay']; ?></td>
                                        <td><?php echo $row['holidays_pay']; ?></td>
                                        <td><?php echo $row['leave_days_pay']; ?></td>
                                        <td><?php echo $row['allowance_pay']; ?></td>
                                        <td><?php echo $row['basic_pay']; ?></td>
                                        <td><?php echo $row['total_deduction']; ?></td>
                                        <td><?php echo $row['net_pay']; ?></td>
                                    </tr>
                                <?php }} ?>
                            </tbody>
                        </table>
                    </div>
            <?php
        }   

}

$salary_class = new salary_report();