
    <?php
      require_once('../php/classes/payrollClass.php');
      $pdo = $classPayroll->openConnection();
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/UI-add.css">
        <title>addEmployee | Symtech</title>
    </head>

    <body>
        <!-- DASHBOARD -->

        <div class="admin-dashboard"> 
            <div class="home-sidebar">
                <img  class="home-logo" src="https://img.icons8.com/glyph-neue/2x/home-page.png" alt="logo">
            </div>
              <header class="top-bar">
                    <h1>SymTech | <p>HR payroll</p></h1>
              </header>
            <ul>
                <li> <a href="#">Dashboard Overview</a></li>
                <li> <a href="../user_interface/UI_addEmployee.php">Employee Management</a></li>
                <li> <a href="../user_interface/UI_setDepartment.php">Department Management</a></li>
                <li> <a href="../user_interface/UI_schedule.php">Scheduling Management</a></li>
                <li> <a href="#">Payroll Management</a></li>
                <li> <a href="#">Employee Salary Report</a></li>
                <li> <a href="#">Payslip Report/Print</a></li>
                <li> <a href="#">Company Report</a></li>
                <li> <a href="#">Company Expenses</a></li>
            </ul>
            <hr>
            <footer>
                <p>No copy right</p>
            </footer>
        </div>
        <header class="secondtop-bar">
             2nd top
        </header>

        <!-- END DASHBOARD -->
        <div class="container">
            <form action="../php/CP_search_em.php" method="post">
                <div class="search-engine">
                    <label>Search For Employee ID </label>
                    <input type="number" name="search_E_ID" id="search_E_ID" >
                    <button type="submit" name="search_e" id="search_e">-></button>
                </div>
            </form>
            <form action="../php/CP_add_em.php" method="post">
                <div class="container-content">
                    <label>E_ID:</label>
                    <input type="number" name="E_ID" id="E_ID" required><br>

                    <label>First Name:</label>
                    <input type="text" name="fname" id="fname" required><br>
                   
                    <label>M.I:</label>
                    <input type="text" name="mi" id="mi" required><br>
                   
                    <label>Last Name:</label>
                    <input type="text" name="lname" id="lname" required><br>
                   
                    <label>Age:</label>
                    <input type="number" name="age" id="age" required><br>
                   
                    <label>Email:</label>
                    <input type="email" name="email" id="email" required><br>
                   
                    <label>Contact:</label>
                    <input type="number" name="contact" id="contact" required><br>
                   
                    <label>Gender:</label>
                    <select name="gender" id="gender" required>
                   
                        <option selected disabled value="">- Select -</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select> <br>
                    <label>Employee Stats:</label>
                    <select name="stats" id="stats" required>
                        <option selected disabled value="">- Select -</option>
                        <option value="Regular">Regular</option>
                        <option value="Contructual">Contructual</option>
                    </select><br>

                    <label>Date Hired:</label>
                    <input type="date" name="date" id="date" required><br>
                </div>

                <div>
                    <button type="submit" name="addEmployee">Save</button>
                    <button disabled="disabled">Update</button>
                    <button disabled="disabled">Delete</button>
                </div>
            
            </form>
        </div>
               <hr>        

<!------------------------------------------ TABLE BELOW IS FOR SHOWING DATA FROM DATABASE ---------------------------------------->
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
                        $pdo = $classPayroll->openConnection();
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