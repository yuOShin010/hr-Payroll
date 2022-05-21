<?php
    require_once ('classes/payrollClass.php');
    $pdo = $classPayroll->openConnection();


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
                                // for employee management module process --


        if(isset($_POST['editEmployee'])){
            $classPayroll->update_employee_module();  // update employee information --
                header("Location: ../operator/UI_addEmployee.php");
        } 
        
        if(isset($_POST['deleteEmployee'])){
            $classPayroll->delete_employee_module();   // soft delete employee information --
                 header("Location: ../operator/UI_addEmployee.php");
        }

        if(isset($_POST['addEmployee'])){
            $classPayroll->addEmployee();              // add employee infromation --
                header('location: ../operator/UI_addEmployee.php');
        }



// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
                                // for set department management module process --



        if(isset($_POST['setDepartment'])){
            $E_ID = $_POST['E_ID'];
            $dept_ID = $_POST['dept_id'];
            $position_ID = $_POST['position_id'];
    
            $sql = "INSERT INTO tbl_employee_department_position (employee_id, dept_id, position_id)
                VALUES (?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$E_ID, $dept_ID, $position_ID]);
    
            echo ("<script LANGUAGE='JavaScript'> window.alert('Successfully Set Department..');
                window.location.href='../operator/UI_setDepartment.php'; </script>");
        }
      
                
        if(isset($_POST['updateDept'])){
            $E_ID = $_POST['E_ID'];
            $dept_ID = $_POST['dept_id'];
            $position_ID = $_POST['position_id'];
    
            $sql = "UPDATE tbl_employee_department_position SET dept_id = ?, position_id = ? WHERE employee_id = ? ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$dept_ID, $position_ID, $E_ID]);
    
            echo ("<script LANGUAGE='JavaScript'> window.alert('Successfully Update Department..');
                window.location.href='../operator/UI_setDepartment.php'; </script>");
        }


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
                                // for scheduling management module process --


            if(isset($_POST['submit'])){
                try {

                    $id = $_POST['id'];
                    $fname = $_POST['fname'];
                    $lname = $_POST['lname'];
                    $email = $_POST['email'];
                    $contact = $_POST['contact'];
                    $deptID = $_POST['deptID'];
                    $position = $_POST['positionID'];
                    $weekly = $_POST['weekly'];
                    $monthly = $_POST['monthly'];
                    $sun = $_POST['sun'];
                    $mon = $_POST['mon'];
                    $tue = $_POST['tue'];
                    $wed = $_POST['wed'];
                    $thu = $_POST['thu'];
                    $fri = $_POST['fri'];
                    $sat = $_POST['sat'];
                    $t_i1 = $_POST['t_i1'];
                    $t_i2 = $_POST['t_i2'];
                    $t_i3 = $_POST['t_i3'];
                    $t_i4 = $_POST['t_i4'];
                    $t_i5 = $_POST['t_i5'];
                    $t_i6 = $_POST['t_i6'];
                    $t_i7 = $_POST['t_i7'];
                    $t_o1 = $_POST['t_o1'];
                    $t_o2 = $_POST['t_o2'];
                    $t_o3 = $_POST['t_o3'];
                    $t_o4 = $_POST['t_o4'];
                    $t_o5 = $_POST['t_o5'];
                    $t_o6 = $_POST['t_o6'];
                    $t_o7 = $_POST['t_o7'];


                } catch (PDOException $e) {
                    die($e->getMessage());
                }
            }



