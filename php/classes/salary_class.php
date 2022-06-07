<?php

class salary_report extends MyPayroll {
    // --------------------------------------------------------- SALARY SAVE BTN ACTIVE --------------------------------------------------------- //

        public function active_save_salary(){ 
            $pdo = $this->openConnection();
            $search_EID = $_POST['search_E_ID'];

                $sql = "SELECT
                A.id,
                B.employee_id, B.isActive, B.first_name, B.last_name, B.email, B.contact, B.stats,
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
                WHERE B.employee_id = ? AND B.isActive = 1 AND A.id > 0";

                $stmt = $pdo->prepare($sql);
                $stmt->execute([$search_EID]);

                if($stmt->rowCount() > 0){

    
                    while($row = $stmt->fetch()){
                        $stats = $row['stats'];
                        $E_ID = $row['employee_id'];
                        $fname = $row['first_name'];
                        $lname = $row['last_name'];
                        $contact = $row['contact'];
                        $dept_id = $row['dept_id'];
                        $dept_code = $row['dept_code'];
                        $position_id = $row['position_id'];
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
                        
                    }
                }?>

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

                        <form action="../php/process.php" method="post">
                            <label>
                            <input class="input-style inpt-pl20" type="number" name="E_ID" id="E_ID" required readonly value="<?php echo $E_ID;?>"> 
                            <p>Employee ID</p>
                            </label>
                            <label>
                                <input class="input-style inpt-pl20" type="text" name="fname" id="fname" required readonly value="<?php echo $fname;?>">
                                <p>First Name</p>
                            </label>
                            <label>
                                <input class="input-style inpt-pl20" type="text" name="lname" id="lname" required readonly value="<?php echo $lname;?>">
                                <p>Last Name</p>
                            </label>
                            <label>
                                <input class="input-style inpt-pl20 removearrow" type="number" name="contact" id="contact" required readonly value="<?php echo $contact;?>">
                                <p>Contact</p>
                            </label>
                            <label>
                                <select name="dept_id">
                                    <option hidden value="<?php echo $dept_id;?>"><?php echo $dept_code;?></option>
                                </select>
                                <p>Department</p>
                            </label>
                            <label>
                                <select name="position_id" id="position_id">
                                    <option hidden value="<?php echo $position_id;?>"><?php echo $position_desc;?></option>
                                </select>
                                <p>Position</p>
                            </label>
                            <br>

                            <label>
                                <input class="input-style inpt-pl20" type="number" name="ot" id="ot" step="any" required readonly value="<?php echo $overtime;?>">
                                <p>Overtime</p>
                            </label>
                            <label>
                                <input class="input-style inpt-pl20" type="number" name="holidays_work" id="holidays_work" required readonly value="<?php echo $holidays_work;?>">
                                <p>Holidays Works</p>
                            </label>
                            <label>
                                <input class="input-style inpt-pl20" type="number" name="allowance" id="allowance" step="any" required readonly value="<?php echo $allowance;?>">
                                <p>Allowance</p>
                            </label>
                            <label>
                                <input class="input-style inpt-pl20" type="number" name="hours_work" id="hours_work" required readonly value="<?php echo $total_workHrs;?>">
                                <p>Work Hours</p>
                            </label>
                            <label>
                                <input class="input-style inpt-pl20" type="number" name="days_work" id="days_work" required readonly value="<?php echo $days_works;?>">
                                <p>Days Work</p>
                            </label>
                            <label>
                                <input class="input-style inpt-pl20" type="number" name="leave_day" id="leave_day" required readonly value="<?php echo $leave_days;?>">
                                <p>Leave Days</p>
                            </label>
                            <br>
                            <h3>Start Here ..</h3>
                            <!-- Pay -->

                            <!-- HIDDEN INPUT BELOW NEED KO ITO WAG MO ALISIN JAY KASAMA TO SA CUMPUTATION -->
                            <input class="input-style inpt-pl20" type="number" name="deduct" id="deduct" step="any" value="<?php echo $total_deduction;?>" required readonly hidden>

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
                                <p>Basic Pay</p>
                            </label>
                            <br><br>
                            <?php
                              if($stats == "Regular"){ ?>
                                    <label>
                                        <input type="button"  name="regular" id="regular" value="Regular" step="any" onclick="regular_button()" required>
                                    </label>
                                    <!-- class="b-size" -->
                                    <label>
                                        <input disabled type="button" name="contractual" id="contractual" value="Contractual" step="any" onclick="contractual_button()" required>
                                    </label> <?php
                                 } else { ?>
                                    <label>
                                        <input disabled type="button"  name="regular" id="regular" value="Regular" step="any" onclick="regular_button()" required>
                                    </label>
                                    <!-- class="b-size" -->
                                    <label>
                                        <input type="button" name="contractual" id="contractual" value="Contractual" step="any" onclick="contractual_button()" required>
                                    </label> <?php
                                 } ?>

                            <br><br>
                            <label>
                                <input class="int-red" type="number" name="total_deduction" id="total_deduction" step="any" required>
                                <p>Deduction Total</p>
                            </label>
                            <label>
                                <input class="int-green" type="number" name="net_pay" id="net_pay" step="any" required>
                                <p>NetPay</p>
                            </label>
                            <button class="button" name="save_salary">Save</button>
                            <button class="button" disabled>Update</button>
                            <!-- <button class="button" disabled>Delete</button> -->
                        </form>
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
                                <!-- <th>Days_work Pay</th> -->
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
                             G.hours_pay, G.ot_pay, G.holidays_pay, G.leave_days_pay, G.allowance_pay, G.basic_pay, G.net_pay
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
                                    <!-- <td><?php // echo $row['days_work_pay']; ?></td> -->
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

                    <script>
                        function regular_button(){
                            var total_hours = parseInt($('#hours_work').val());
                            var overtime = parseFloat($("#ot").val());
                            var holidays_work = parseInt($("#holidays_work").val());
                            var leave_day = parseInt($("#leave_day").val());
                            var allowance = parseFloat($("#allowance").val());
                            var position = $("#position_id").val();
                            // var position = 1;
                            // var regular_rate = 1.3;
                            var deduct = parseFloat($("#deduct").val());
                            var basic_pay;
                            var net_pay;

                            if(position == '1'){
                                // alert('im here sa loob ng if else');
                                var total_hours_pay = total_hours * 132;
                                var overtime_pay = overtime * 198;
                                var holiday_rate = (1056 * .3) + 1056; // wag itong isama sa computation ng basic pay 
                                var holidays_work_pay = holiday_rate * holidays_work;
                                var leave_day_pay = (1056 * .5) * leave_day;
                                var allowance_pay = allowance * 1;

                                basic_pay = total_hours_pay + overtime_pay + holidays_work_pay + leave_day_pay + allowance_pay;
                                net_pay = basic_pay - deduct;

                                parseFloat($("#total_hrs_pay").val(total_hours_pay));
                                parseFloat($("#ot_pay").val(overtime_pay));
                                parseFloat($("#holidays_pay").val(holidays_work_pay));
                                parseFloat($("#leave_pay").val(leave_day_pay));
                                parseFloat($("#allowance_pay").val(allowance_pay));
                                parseFloat($("#basic_pay").val(basic_pay));
                                parseFloat($("#total_deduction").val(deduct));
                                parseFloat($("#net_pay").val(net_pay));

                            } else if(position == '2'){

                                var total_hours_pay = total_hours * 105;
                                var overtime_pay = overtime * 158;
                                var holiday_rate = (845* .3) + 845; // wag itong isama sa computation ng basic pay 
                                var holidays_work_pay = holiday_rate * holidays_work;
                                var leave_day_pay = (845 * .5) * leave_day;
                                var allowance_pay = allowance * 1;

                                basic_pay = total_hours_pay + overtime_pay + holidays_work_pay + leave_day_pay + allowance_pay;
                                net_pay = basic_pay - deduct;

                                parseFloat($("#total_hrs_pay").val(total_hours_pay));
                                parseFloat($("#ot_pay").val(overtime_pay));
                                parseFloat($("#holidays_pay").val(holidays_work_pay));
                                parseFloat($("#leave_pay").val(leave_day_pay));
                                parseFloat($("#allowance_pay").val(allowance_pay));
                                parseFloat($("#basic_pay").val(basic_pay));
                                parseFloat($("#total_deduction").val(deduct));
                                parseFloat($("#net_pay").val(net_pay));

                            } else if(position == '3'){

                                var total_hours_pay = total_hours * 92;
                                var overtime_pay = overtime * 139;
                                var holiday_rate = (739* .3) + 739; // wag itong isama sa computation ng basic pay 
                                var holidays_work_pay = holiday_rate * holidays_work;
                                var leave_day_pay = (739 * .5) * leave_day;
                                var allowance_pay = allowance * 1;

                                basic_pay = total_hours_pay + overtime_pay + holidays_work_pay + leave_day_pay + allowance_pay;
                                net_pay = basic_pay - deduct;

                                parseFloat($("#total_hrs_pay").val(total_hours_pay));
                                parseFloat($("#ot_pay").val(overtime_pay));
                                parseFloat($("#holidays_pay").val(holidays_work_pay));
                                parseFloat($("#leave_pay").val(leave_day_pay));
                                parseFloat($("#allowance_pay").val(allowance_pay));
                                parseFloat($("#basic_pay").val(basic_pay));
                                parseFloat($("#total_deduction").val(deduct));
                                parseFloat($("#net_pay").val(net_pay));

                            } else if(position == '4'){

                                var total_hours_pay = total_hours * 119;
                                var overtime_pay = overtime * 178;
                                var holiday_rate = (950* .3) + 950; // wag itong isama sa computation ng basic pay 
                                var holidays_work_pay = holiday_rate * holidays_work;
                                var leave_day_pay = (950 * .5) * leave_day;
                                var allowance_pay = allowance * 1;

                                basic_pay = total_hours_pay + overtime_pay + holidays_work_pay + leave_day_pay + allowance_pay;
                                net_pay = basic_pay - deduct;

                                parseFloat($("#total_hrs_pay").val(total_hours_pay));
                                parseFloat($("#ot_pay").val(overtime_pay));
                                parseFloat($("#holidays_pay").val(holidays_work_pay));
                                parseFloat($("#leave_pay").val(leave_day_pay));
                                parseFloat($("#allowance_pay").val(allowance_pay));
                                parseFloat($("#basic_pay").val(basic_pay));
                                parseFloat($("#total_deduction").val(deduct));
                                parseFloat($("#net_pay").val(net_pay));

                            } else if(position == '5'){

                                var total_hours_pay = total_hours * 79;
                                var overtime_pay = overtime * 119;
                                var holiday_rate = (634* .3) + 634; // wag itong isama sa computation ng basic pay 
                                var holidays_work_pay = holiday_rate * holidays_work;
                                var leave_day_pay = (634 * .5) * leave_day;
                                var allowance_pay = allowance * 1;

                                basic_pay = total_hours_pay + overtime_pay + holidays_work_pay + leave_day_pay + allowance_pay;
                                net_pay = basic_pay - deduct;

                                parseFloat($("#total_hrs_pay").val(total_hours_pay));
                                parseFloat($("#ot_pay").val(overtime_pay));
                                parseFloat($("#holidays_pay").val(holidays_work_pay));
                                parseFloat($("#leave_pay").val(leave_day_pay));
                                parseFloat($("#allowance_pay").val(allowance_pay));
                                parseFloat($("#basic_pay").val(basic_pay));
                                parseFloat($("#total_deduction").val(deduct));
                                parseFloat($("#net_pay").val(net_pay));

                            } else {
                                alert('IF ELSE STATEMENT IS ERROR');
                            }

                        }
                    </script>

                    <script>
                        function contractual_button(){
                            var total_hours = parseInt($('#hours_work').val());
                            var overtime = parseFloat($("#ot").val());
                            var holidays_work = parseInt($("#holidays_work").val());
                            var leave_day = parseInt($("#leave_day").val());
                            var allowance = parseFloat($("#allowance").val());
                            var position = $("#position_id").val();
                            // var position = 1;
                            // var regular_rate = 1.3;
                            var deduct = parseFloat($("#deduct").val());
                            var basic_pay;
                            var net_pay;

                            if(position == '1'){
                                // Dept Head
                                var total_hours_pay = total_hours * 125;
                                var overtime_pay = overtime * 187.5;
                                var holiday_rate = (1000 * .3) + 1000; // wag itong isama sa computation ng basic pay 
                                var holidays_work_pay = holiday_rate * holidays_work;
                                var leave_day_pay = (1000 * .5) * leave_day;
                                var allowance_pay = allowance * 1;

                                basic_pay = total_hours_pay + overtime_pay + holidays_work_pay + leave_day_pay + allowance_pay;
                                net_pay = basic_pay - deduct;

                                parseFloat($("#total_hrs_pay").val(total_hours_pay));
                                parseFloat($("#ot_pay").val(overtime_pay));
                                parseFloat($("#holidays_pay").val(holidays_work_pay));
                                parseFloat($("#leave_pay").val(leave_day_pay));
                                parseFloat($("#allowance_pay").val(allowance_pay));
                                parseFloat($("#basic_pay").val(basic_pay));
                                parseFloat($("#total_deduction").val(deduct));
                                parseFloat($("#net_pay").val(net_pay));

                            } else if(position == '2'){
                                // Teacher
                                var total_hours_pay = total_hours * 100;
                                var overtime_pay = overtime * 150;
                                var holiday_rate = (800* .3) + 800; // wag itong isama sa computation ng basic pay 
                                var holidays_work_pay = holiday_rate * holidays_work;
                                var leave_day_pay = (800 * .5) * leave_day;
                                var allowance_pay = allowance * 1;

                                basic_pay = total_hours_pay + overtime_pay + holidays_work_pay + leave_day_pay + allowance_pay;
                                net_pay = basic_pay - deduct;

                                parseFloat($("#total_hrs_pay").val(total_hours_pay));
                                parseFloat($("#ot_pay").val(overtime_pay));
                                parseFloat($("#holidays_pay").val(holidays_work_pay));
                                parseFloat($("#leave_pay").val(leave_day_pay));
                                parseFloat($("#allowance_pay").val(allowance_pay));
                                parseFloat($("#basic_pay").val(basic_pay));
                                parseFloat($("#total_deduction").val(deduct));
                                parseFloat($("#net_pay").val(net_pay));

                            } else if(position == '3'){
                                // Office staff
                                var total_hours_pay = total_hours * 87.5;
                                var overtime_pay = overtime * 131.25;
                                var holiday_rate = (700* .3) + 700; // wag itong isama sa computation ng basic pay 
                                var holidays_work_pay = holiday_rate * holidays_work;
                                var leave_day_pay = (700 * .5) * leave_day;
                                var allowance_pay = allowance * 1;

                                basic_pay = total_hours_pay + overtime_pay + holidays_work_pay + leave_day_pay + allowance_pay;
                                net_pay = basic_pay - deduct;

                                parseFloat($("#total_hrs_pay").val(total_hours_pay));
                                parseFloat($("#ot_pay").val(overtime_pay));
                                parseFloat($("#holidays_pay").val(holidays_work_pay));
                                parseFloat($("#leave_pay").val(leave_day_pay));
                                parseFloat($("#allowance_pay").val(allowance_pay));
                                parseFloat($("#basic_pay").val(basic_pay));
                                parseFloat($("#total_deduction").val(deduct));
                                parseFloat($("#net_pay").val(net_pay));

                            } else if(position == '4'){
                                // Secretary
                                var total_hours_pay = total_hours * 112.5;
                                var overtime_pay = overtime * 168.75;
                                var holiday_rate = (900* .3) + 900; // wag itong isama sa computation ng basic pay 
                                var holidays_work_pay = holiday_rate * holidays_work;
                                var leave_day_pay = (900 * .5) * leave_day;
                                var allowance_pay = allowance * 1;

                                basic_pay = total_hours_pay + overtime_pay + holidays_work_pay + leave_day_pay + allowance_pay;
                                net_pay = basic_pay - deduct;

                                parseFloat($("#total_hrs_pay").val(total_hours_pay));
                                parseFloat($("#ot_pay").val(overtime_pay));
                                parseFloat($("#holidays_pay").val(holidays_work_pay));
                                parseFloat($("#leave_pay").val(leave_day_pay));
                                parseFloat($("#allowance_pay").val(allowance_pay));
                                parseFloat($("#basic_pay").val(basic_pay));
                                parseFloat($("#total_deduction").val(deduct));
                                parseFloat($("#net_pay").val(net_pay));

                            } else if(position == '5'){
                                // Utility
                                var total_hours_pay = total_hours * 75;
                                var overtime_pay = overtime * 112.5;
                                var holiday_rate = (600* .3) + 600; // wag itong isama sa computation ng basic pay 
                                var holidays_work_pay = holiday_rate * holidays_work;
                                var leave_day_pay = (600 * .5) * leave_day;
                                var allowance_pay = allowance * 1;

                                basic_pay = total_hours_pay + overtime_pay + holidays_work_pay + leave_day_pay + allowance_pay;
                                net_pay = basic_pay - deduct;

                                parseFloat($("#total_hrs_pay").val(total_hours_pay));
                                parseFloat($("#ot_pay").val(overtime_pay));
                                parseFloat($("#holidays_pay").val(holidays_work_pay));
                                parseFloat($("#leave_pay").val(leave_day_pay));
                                parseFloat($("#allowance_pay").val(allowance_pay));
                                parseFloat($("#basic_pay").val(basic_pay));
                                parseFloat($("#total_deduction").val(deduct));
                                parseFloat($("#net_pay").val(net_pay));

                            } else {
                                alert('IF ELSE STATEMENT IS ERROR');
                            }

                        }
                    </script>

                    

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