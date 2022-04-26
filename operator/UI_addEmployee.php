<?php
session_start();
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>addEmployee | Symtech</title>
    </head>

    <body>
        <!-- DASHBOARD -->

        <div class="admin-dashboard"> 
            <div class="home-sidebar">
                <img  class="home-logo" src="https://img.icons8.com/glyph-neue/2x/home-page.png" alt="logo">
            </div>
              <div class="top-bar">
                    <h1>SymTech | <p>HR payroll</p></h1>
              </div>
            <ul>
                 <!-- <li> <a href="../operator/UI_dash_overview.php">Dashboard Overview</a></li> -->
                 <li> <a href="../operator/UI_addEmployee.php">Employee Management</a></li>
                <li> <a href="../operator/UI_setDepartment.php">Department Management</a></li>
                <li> <a href="../operator/UI_schedule.php">Scheduling Management</a></li>
                <li> <a href="../operator/UI_payroll.php">Payroll Management</a></li>
                <li> <a href="#">Employee Salary Report</a></li>
                <li> <a href="#">Payslip Report/Print</a></li>
                <li> <a href="#">Company Report</a></li>
                <!--<li> <a href="#">Company Expenses</a></li> -->
            </ul>
            <hr>

            <footer>
                <p>No copy right</p>
            </footer>
        </div>
        <header class="secondtop-bar">
            <?php 

            if(isset($_SESSION['User']))
            {
                echo '<h1>'.' Welcome ' . $_SESSION['User'].'</h1>';
                echo '<a href="logout_OP.php?logout">Logout</a>';
            }
            else
            {
                header("location:../index_OP.php");
            }
            
            ?>
        </header>

        <!-- END DASHBOARD -->
        <?php
            $activeForm = true ;

            if(isset($_POST['search_e'])){
                $activeForm = false;

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

            }
            ?>

            <div class="container">
                    <form action="UI_addEmployee.php" method="post">      <!-- form search-->
                        <div class="search-engine">
                            <label>Search For Employee ID </label>
                            <input type="number" name="search_E_ID" id="search_E_ID" >
                            <button type="submit" name="search_e" id="search_e">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            </button>
                        </div>
                    </form>
                </div>
            


        <div class="container2">
             <form action="../php/process.php" method="post">      <!-- form -->
                <div class="search-engine">
                        <input type="number" name="E_ID" id="E_ID" value="<?php echo "$E_ID" ;?>" required><br>
                        <label>Employee Id:</label>
                </div>  
                
                <div class="container-content">
                        <input type="text" name="fname" id="fname" value="<?php echo "$fname" ;?>" required><br>      
                        <label>First Name:</label>
                </div>
                <div class="container-content">     
                        <input type="text" name="mi" id="mi" value="<?php echo "$mi" ;?>" required><br>
                        <label>M.I:</label>
                </div>
                <div class="container-content">     
                        <input type="text" name="lname" id="lname" value="<?php echo "$lname" ;?>" required><br>
                        <label>Last Name:</label>
                </div>    
                <div class="container-content"> 
                        <input type="number" name="age" id="age" value="<?php echo "$age" ;?>" required><br>
                        <label>Age:</label>
                </div>   
                <div class="container-content"> 
                        <input type="email" name="email" id="email" value="<?php echo "$email" ;?>" required><br>
                        <label>Email:</label>
                </div>
                <div class="container-content">       
                        <input type="number" name="contact" id="contact" value="<?php echo "$contact" ;?>" required><br>
                        <label>Contact:</label>
                </div>     

                <div class="container-content">
                        <label>Date Hired:</label>
                        <input type="date" name="date" id="date" value="<?php echo "$date" ;?>" required><br>
                        
                </div>
                <div class="container-content-select">
                        <select name="gender" id="gender" required>
                            <label>Gender:</label>
                            <option selected disabled value="<?php echo "$gender" ;?>"><?php echo "$gender" ;?></option>
                            <optgroup label="-Select New-"></optgroup>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select> 
                    </div>
                <div class="container-content-select1">
                        <label>Employee Stats:</label>
                        <select name="stats" id="stats" required>
                            <option selected disabled value="<?php echo "$stats" ;?>"><?php echo "$stats" ;?></option>
                            <optgroup label="-Select New-"></optgroup>
                            <option value="Regular">Regular</option>
                            <option value="Contructual">Contructual</option>
                        </select>
                </div>
                        <div>
                            <button disabled>Save</button>
                            <button type="submit" name="editEmployee">Update</button>
                            <button type="submit" name="deleteEmployee">Delete</button>
                        </div>
                </form>
        </div> 
        
        
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
    
        <?php
        }

            if($activeForm){

        ?>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------- -->
        <div class="container">
            <form action="UI_addEmployee.php" method="post">    <!-- form search-->
                <div class="search-engine">
                    <input type="number" name="search_E_ID" id="search_E_ID" >
                    <label>Search For Employee ID </label>
                    <button type="submit" name="search_e" id="search_e">-></button>
                </div>
            </form>
            
            <div class="container2">
                <form action="../php/CP_add_em.php" method="post">      <!-- form -->
                    <div class="container-content">
                        <input type="number" name="E_ID" id="E_ID" required><br>
                        <label>E_ID:</label>
                    </div>

                    <div class="container-content">
                        <input type="text" name="fname" id="fname" required><br>
                        <label>First Name:</label>
                    </div> 
                    <div class="container-content">
                        <input type="text" name="mi" id="mi" required><br>
                        <label>M.I:</label>
                    </div> 
                    <div class="container-content"> 
                        <input type="text" name="lname" id="lname" required><br>
                        <label>Last Name:</label>
                    </div> 
                    <div class="container-content"> 
                        <input type="number" name="age" id="age" required><br>
                        <label>Age:</label>
                    </div> 
                    <div class="container-content"> 
                        <input type="email" name="email" id="email" required><br>
                        <label>Email:</label>
                    </div>   
                    <div class="container-content">  
                        <input type="number" name="contact" id="contact" required><br>
                        <label>Contact:</label>
                    </div> 

                    <div class="container-content">
                        <input type="date" name="date" id="date" required><br>
                        <label>Date Hired:</label>
                    </div>
                    
                    <div class="container-content-select"> 
                        <select name="gender" id="gender" required>
                                <label>Gender:</label>  
                                <option selected disabled value="">- Select -</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        
                    </div>

                    <div class="container-content-select1">
                        <label>Employee Stats:</label>
                            <select name="stats" id="stats" required>
                            <option selected disabled value="">Select</option>
                            <option value="Regular">Regular</option>
                            <option value="Contructual">Contructual</option>
                        </select>
                        
                    </div>
                    

                    <div class="container-content">
                        <button class="save" type="submit" name="addEmployee">Save</button>
                        <button disabled="disabled">Update</button>
                        <button disabled="disabled">Delete</button>
                    </div>
                
                </form>
            </div>
        </div>       

<!------------------------------------------ TABLE BELOW IS FOR SHOWING DATA FROM DATABASE ---------------------------------------->
        <div class="output">
            <table class="table table-dark table-striped">
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

        <?php } ?>
        
    </body>
</html>