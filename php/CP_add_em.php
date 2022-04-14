<?php
    require_once ('../php/classes/payrollClass.php');

        if(isset($_POST['addEmployee'])){
            $classPayroll->addEmployee();
        }elseif($_POST['setDepartment']){
            $classPayroll->setDepartment();
        }


?>