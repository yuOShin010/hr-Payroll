<?php
    require_once('../php/classes/payrollClass.php');
    $pdo = $classPayroll->openConnection();

    if (isset($_POST['set_schedule'])){
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

            echo "Submit Succes!";
        } else {
            echo "Wrong Statement!";
        }
    }

     if(isset($_POST['all'])){
        $timeIn = $_POST['timeIn'];
        $timeOut = $_POST['timeOut'];

        echo "Your time in is: ".$timeIn; 
        echo "Your time Out is: ".$timeOut; 


     }

?>








<!-- 
    // if(isset($_POST['computeDays'])){
    //     $d_from = $_POST['d_from'];
    //     $d_to = $_POST['d_to'];
    //         // Declare two dates
    //     $start_date = strtotime($d_from);
    //     $end_date = strtotime($d_to);
        
    //     // Get the difference and divide into
    //     // total no. seconds 60/60/24 to get
    //     // number of days
    //     // echo "Difference between two dates: "
    //     //     . ($end_date - $start_date)/60/60/24;
        
    //     } -->