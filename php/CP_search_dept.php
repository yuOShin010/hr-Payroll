<?php
    require_once ('../php/classes/payrollClass.php');
    $pdo = $classPayroll->openConnection();

    // Search for add employee Module --

        if(isset($_POST['search_d']))
        {
            $search_e_id = $_POST["search_E_ID"];
            $sql_search = "SELECT * FROM `employee` WHERE `employee_id` = ? AND isActive = 1";
            $stmt = $pdo->prepare($sql_search);
            $stmt->execute([$search_e_id]);

            if($stmt->rowCount() > 0)
            {
                while($row = $stmt->fetch()){

                $E_ID = $row['employee_id'];
                $fname = $row['first_name'];
                $mi = $row['middle_in'];
                $lname = $row['last_name'];
                $age = $row['age'];
                $email = $row['email'];
                $contact = $row['contact'];
                $gender = $row['gender'];
                $stats = $row['stats'];
                $date = $row['date_hired'];


            }

            }else{
            $E_ID = "";
            $fname = "";
            $mi = "";
            $lname = "";
            $age = "";
            $email = "";
            $contact = "";
            $gender = "";
            $stats = "";
            $date = "";

// ------------------------------------------------------------------------------------------------------------------------------------------- //



// ------------------------------------------------------------------------------------------------------------------------------------------- //

            header("Location: ../user_interface/UI_addEmployee.php");

            }

        }else{
        $E_ID = "";
        $fname = "";
        $mi = "";
        $lname = "";
        $age = "";
        $email = "";
        $contact = "";
        $gender = "";
        $stats = "";
        $date = "";
        }


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>addEmployee | Symtech</title>
    </head>

    <style>
        body {
            background-color: #6C6169;
        }

        form {
            text-align: center;
            margin-top: 5px;       
        }

        label, input , textarea, select{
            margin-top: 10px;
        }

        button {
            margin-top: 8px;
        }

        table{
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, tr, th, td{
            border:1px solid black;
        }

        th, td{
            padding: 10px 20px;
        }
    </style>

    <body>

        <form action="" method="post">
            <div>
                <label>Search For Employee E_ID:</label>
                <input type="number" name="search_E_ID" id="search_E_ID" >
                <button type="submit" name="search_e" id="search_e">-></button>
            </div>
        </form>


        <form action="../php/CP_search_em.php" method="post">
            <div>
                <label>Search For Employee E_ID:</label>
                <input type="number" name="search_E_ID" id="search_E_ID" >
                <button type="submit" name="search_d" id="search_d">-></button>
            </div>
        </form>


        <form action="../php/CP_add_em.php" method="post">
            <div>
                <label>E_ID:</label>
                <input disabled type="number" name="E_ID" id="E_ID" required><br>
                <label>First Name:</label>
                <input disabled type="text" name="fname" id="fname" required><br>
                <label>M.I:</label>
                <input disabled type="text" name="mi" id="mi" required><br>
                <label>Last Name:</label>
                <input disabled type="text" name="lname" id="lname" required><br>
                <label>Contact:</label>
                <input disabled type="number" name="contact" id="contact" required><br>
                <label>Position:</label>
                <input disabled list="position1" name="position" id="position">
                    <datalist id="position1">
                        <option value="Office Staff">
                        <option value="Teacher">
                        <option value="Security Guard">
                        <option value="Utility">
                        <option value="Dept. Head">
                    </datalist> <br>
                <label>Employee Dept:</label>
                <input list="dept1" name="dept" id="dept">
                <datalist id="dept1">
                    <option value="BSIT">
                    <option value="BSOA">
                    <option value="BSED">
                    <option value="BEED">
                    <option value="BSCRIM">
                    <option value="BSTM">
                </datalist> <br>
                <label>Dept. Assigned Date:</label>
                <input type="date" name="ass_date" id="ass_date" required><br>
            </div>

            <div>
            <button disabled="disabled">Save</button>
                <button type="submit" name="edit_setEmployee">Update</button>
                <button type="submit" name="delete_setEmployee">Delete</button>
            </div>
        </form>
        <br><br>   <hr>   <br><br>      

<!------------------------------------------ TABLE BELOW IS FOR SHOWING DATA FROM DATABASE ADD EMPLOYEE MODULE ---------------------------------------->

        <div>
            <table>
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>First Name</th>
                        <th>M.I</th>
                        <th>Last Name</th>
                        <th>Age</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Gender</th>
                        <th>Stats</th>
                        <th>Date Hired</th>
                    </tr>
                </thead>

                <tbody> 
                    <?php
                        $sql = "SELECT * FROM employee WHERE isActive = 1;";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();

                        if($stmt->rowCount() > 0){
                            while($row = $stmt->fetch()){
                    ?>
                    <tr>
                        <td><?php echo $row['employee_id']; ?></td>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['middle_in']; ?></td>
                        <td><?php echo $row['last_name']; ?></td>
                        <td><?php echo $row['age']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['contact']; ?></td>
                        <td><?php echo $row['gender']; ?></td>
                        <td><?php echo $row['stats']; ?></td>
                        <td><?php echo $row['date_hired']; ?></td>
                    </tr>
                    <?php }} ?>
                </tbody>
            </table>
        </div>

    </body>

</html>

