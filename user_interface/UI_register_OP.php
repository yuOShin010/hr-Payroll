<?php
    require_once('../php/classes/payrollClass.php');
    $classPayroll->register_op();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Operator | Symtech</title>
</head>

<style> * { text-align: center ;} </style>

<body>

    <form action="" method="post">
        <div>
            <label>Email:</label>
            <input type="email" name="op_email" id="op_email" required><br>
            <label>Password:</label>
            <input type="text" name="op_pass" id="op_pass" required><br>
            <label>First Name:</label>
            <input type="text" name="op_fn" id="op_fn" required><br>
            <label>Middle Name:</label>
            <input type="text" name="op_mn" id="op_mn" required><br>
            <label>Last Name:</label>
            <input type="text" name="op_ln" id="op_ln" required><br>

        <div>
            <button type="submit" name="add_op">Create Account</button>
        </div>
    </form>

</body>
</html>