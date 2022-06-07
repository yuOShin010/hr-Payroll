<?php
    require_once ('classes/payrollClass.php');
    $pdo = $classPayroll->openConnection();
?>

<!DOCTYPE html>
<head>
    <script src="../sweet_alert/jquery-3.6.0.min.js"></script>
    <script src="../sweet_alert/sweetalert2.all.min.js"></script>
    <title>SymTech</title>
</head>
<body>


<?php
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
                                // for employee management module process --

        if(isset($_POST['addEmployee'])){
            $classPayroll->addEmployee();              // add employee infromation --
        }
                                
        if(isset($_POST['editEmployee'])){
            $classPayroll->update_employee_module();  // update employee information --
        } 
        
        if(isset($_POST['deleteEmployee'])){
            $classPayroll->delete_employee_module();   // soft delete employee information --
                 header("Location: ../operator/UI_addEmployee.php");
        }




// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
                                // for set department management module process --



        if(isset($_POST['setDepartment'])){    // for Set Department
            $E_ID = $_POST['E_ID'];
            $dept_ID = $_POST['dept_id'];
            $position_ID = $_POST['position_id'];
    
            $sql = "INSERT INTO tbl_employee_department_position (employee_id, dept_id, position_id)
                VALUES (?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$E_ID, $dept_ID, $position_ID]);
    
                echo "<script>";
                echo "Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Department has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            if(result) {
                                window.location.href='../operator/UI_setDepartment.php';
                            }
                        })";
                echo "</script>";

            // echo ("<script LANGUAGE='JavaScript'> window.alert('Successfully Set Department..');
            //     window.location.href='../operator/UI_setDepartment.php'; </script>");
        }
      
                
        if(isset($_POST['updateDept'])){    // for Update Department
            $E_ID = $_POST['E_ID'];
            $dept_ID = $_POST['dept_id'];
            $position_ID = $_POST['position_id'];
    
            $sql = "UPDATE tbl_employee_department_position SET dept_id = ?, position_id = ? WHERE employee_id = ? ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$dept_ID, $position_ID, $E_ID]);
    
            echo "<script>";
                echo "Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Update successfully',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            if(result) {
                                window.location.href='../operator/UI_setDepartment.php';
                            }
                        })";
                echo "</script>";
            
            // echo ("<script LANGUAGE='JavaScript'> window.alert('Successfully Update Department..');
            //     window.location.href='../operator/UI_setDepartment.php'; </script>");
        }


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
                                // for scheduling management module process --


        if (isset($_POST['set_schedule'])){     // for set Schedule
            $E_ID = $_POST['E_ID'];
            $dept_ID = $_POST['dept_id'];
            $position_ID = $_POST['position_id'];
            $work_hrs = $_POST['workHrs'];
            $d_from = $_POST['d_from'];
            $d_to = $_POST['d_to'];
            $daysWork = $_POST['daysWork'];
    
            $sql = "INSERT INTO tbl_employee_schedule (employee_id, dept_id, position_id)
            VALUES (?,?,?);";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$E_ID, $dept_ID, $position_ID]);
    
            if($stmt){
                $sql2 = "INSERT INTO schedule (total_workHrs, employee_id, d_from, d_to, days_works)
                VALUES (?,?,?,?,?)";
                $stmt2 = $pdo->prepare($sql2);
                $stmt2->execute([$work_hrs, $E_ID, $d_from, $d_to, $daysWork]);
    
                echo "<script>";
                echo "Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Schedule data has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            if(result) {
                                window.location.href='../operator/UI_schedule.php';
                            }
                        })";
                echo "</script>";
                
            } else {
                echo "Wrong Statement!";
            }
        }

        if (isset($_POST['updateSchedule'])){       // for Update Schedule
            $E_ID = $_POST['E_ID'];
            $work_hrs = $_POST['workHrs'];
            $d_from = $_POST['d_from'];
            $d_to = $_POST['d_to'];
            $daysWork = $_POST['daysWork'];

            $sql = "UPDATE schedule SET total_workHrs = ?, d_from = ?, d_to = ?, days_works = ? WHERE employee_id = ? ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$work_hrs, $d_from, $d_to, $daysWork, $E_ID]);

                echo "<script>";
                echo "Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Update successfully',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        if(result) {
                            window.location.href='../operator/UI_schedule.php';
                        }
                    })";
                echo "</script>";

        }

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
                                //  PAYROLL MANAGEMENT PROCESS MODULE --

        if(isset($_POST['addPayroll'])){    // Save Button in Payroll management active
            $E_ID = $_POST['E_ID'];
            $dept_ID = $_POST['dept_id'];
            $position_id = $_POST['position_id'];
            $overtime = $_POST['overtime'];
            $allowance = $_POST['allowance'];
            $holidays_work = $_POST['holidays_work'];
            $leave_days = $_POST['leave_days'];
            $sss = $_POST['sss'];
            $tax = $_POST['tax'];
            $pag_ibig = $_POST['pag_ibig'];
            $phil_health = $_POST['phil_health'];
            $sss_loan = $_POST['sss_loan'];
            $tax_loan = $_POST['tax_loan'];
            $pag_ibig_loan = $_POST['pag_ibig_loan'];
            $phil_health_loan = $_POST['phil_health_loan'];
            $others = $_POST['others'];
            $total_deductions = $_POST['total_deductions'];

            // First insertion in table (tbl_employee_payroll)
            $sql = "INSERT INTO tbl_employee_payroll (employee_id, dept_id, position_id) VALUES (?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$E_ID, $dept_ID, $position_id]);

            // if($stmt){
            // First insertion in table (payroll)
                $sql = " INSERT INTO payroll (employee_id, overtime, allowance, holidays_work, leave_days, sss, tax, pag_ibig, phil_health, sss_loan, tax_loan, pag_ibig_loan, phil_health_loan, others, total_deduction) 
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$E_ID, $overtime, $allowance, $holidays_work, $leave_days, $sss, $tax, $pag_ibig, $phil_health, $sss_loan, $tax_loan, $pag_ibig_loan, $phil_health_loan, $others, $total_deductions]);

                // echo ("<script LANGUAGE='JavaScript'> window.alert('Successfully Insert payroll Data..');
                //     window.location.href='../operator/UI_payroll.php'; </script>");
                
                echo "<script>";
                echo "Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Payroll data has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            if(result) {
                                window.location.href='../operator/UI_payroll.php';
                            }
                        })";
                echo "</script>";

        }

        if(isset($_POST['updatePayroll'])){
            
            $E_ID = $_POST['E_ID'];
            $overtime = $_POST['overtime'];
            $allowance = $_POST['allowance'];
            $holidays_work = $_POST['holidays_work'];
            $leave_days = $_POST['leave_days'];
            $sss = $_POST['sss'];
            $tax = $_POST['tax'];
            $pag_ibig = $_POST['pag_ibig'];
            $phil_health = $_POST['phil_health'];
            $sss_loan = $_POST['sss_loan'];
            $tax_loan = $_POST['tax_loan'];
            $pag_ibig_loan = $_POST['pag_ibig_loan'];
            $phil_health_loan = $_POST['phil_health_loan'];
            $others = $_POST['others'];
            $total_deductions = $_POST['total_deductions'];

            $sql = "UPDATE payroll SET overtime = ?, allowance = ?, holidays_work = ?,  leave_days = ? , sss = ?, tax = ?, pag_ibig = ?, phil_health = ?, sss_loan = ?,
            tax_loan = ?, pag_ibig_loan = ?, phil_health_loan = ?, others = ?, total_deduction = ? WHERE employee_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$overtime, $allowance, $holidays_work, $leave_days, $sss, $tax, $pag_ibig, $phil_health, $sss_loan, $tax_loan, $pag_ibig_loan, $phil_health_loan, $others, $total_deductions, $E_ID]);

            // echo ("<script LANGUAGE='JavaScript'> window.alert('Successfully Update payroll Data..');
            //         window.location.href='../operator/UI_payroll.php'; </script>");    
                
                echo "<script>";
                echo "Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Update successfully',
                            showConfirmButton: false,
                            timer: 1700
                        }).then((result) => {
                            if(result) {
                                window.location.href='../operator/UI_payroll.php';
                            }
                        })";
                echo "</script>";
        }

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
                                //  SALARY REPORT PROCESS MODULE --

        if(isset($_POST['save_salary'])){
            $E_ID = $_POST['E_ID'];
            $dept_id = $_POST['dept_id'];
            $position_id = $_POST['position_id'];
            $total_hrs_pay = $_POST['total_hrs_pay'];
            $ot_pay = $_POST['ot_pay'];
            $holidays_pay = $_POST['holidays_pay'];
            $leave_pay = $_POST['leave_pay'];
            $allowance_pay = $_POST['allowance_pay'];
            $basic_pay = $_POST['basic_pay'];
            $net_pay = $_POST['net_pay'];

            $sql = "INSERT INTO tbl_employee_salary (employee_id, dept_id, position_id) VALUES (?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$E_ID, $dept_id, $position_id]);

            $sql = "INSERT INTO salary_report (employee_id, hours_pay, ot_pay, holidays_pay, leave_days_pay, allowance_pay, basic_pay, net_pay)
            VALUES (?,?,?,?,?,?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$E_ID, $total_hrs_pay, $ot_pay, $holidays_pay, $leave_pay, $allowance_pay, $basic_pay, $net_pay]);

            echo "<script>";
                echo "Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Data inserted into database',
                            showConfirmButton: false,
                            timer: 1700
                        }).then((result) => {
                            if(result) {
                                window.location.href='../operator/UI_payroll.php';
                            }
                        })";
                echo "</script>";
        }
           
?>
</body>
</html>


