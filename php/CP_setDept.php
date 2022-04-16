<?php
    require_once('../php/classes/payrollClass.php');
    $pdo = $classPayroll->openConnection(); 
  
       
    if(isset($_POST['setDepartment'])){
        $E_ID = $_POST['E_ID'];
        $dept_ID = $_POST['dept_id'];
        $position_ID = $_POST['position_id'];

        $sql = "INSERT INTO tbl_employee_department_position (employee_id, dept_id, position_id)
            VALUES (?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$E_ID, $dept_ID, $position_ID]);

        echo ("<script LANGUAGE='JavaScript'> window.alert('Successfully Set Department..');
            window.location.href='http://localhost/hr_payroll/user_interface/UI_setDepartment.php'; </script>");
    }
  
            
    if(isset($_POST['updateDept'])){
        $E_ID = $_POST['E_ID'];
        $dept_ID = $_POST['dept_id'];
        $position_ID = $_POST['position_id'];

        $sql = "UPDATE tbl_employee_department_position SET dept_id = ?, position_id = ? WHERE employee_id = ? ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$dept_ID, $position_ID, $E_ID]);

        echo ("<script LANGUAGE='JavaScript'> window.alert('Successfully Update Department..');
            window.location.href='http://localhost/hr_payroll/user_interface/UI_setDepartment.php'; </script>");
    }