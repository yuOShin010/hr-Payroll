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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/dashboard.css">
    <!-- <link rel="stylesheet" href="../css/UI_setDepartment.css"> -->
    <title>Employee Management</title>

    <script>
        function show() {
            document.getElementById('navigation').classList.toggle('active');
        }

        $('#navigation').click(function() {
            $(".toggle-btn").toggleClass(close);
        });
    </script>


</head>

<body>
    <!-- DASHBOARD -->

    <div id="navigation">
        <div id="nav">
            <div class="toggle-btn" onclick="show()">
                <span class="line top"></span>
                <span class="line middle"></span>
                <span class="line buttom"></span>
            </div>
        </div>
        <div class="side-bar">
            <h3>SymTech</h3>
        </div>
        <ul>

            <li> <a href="../operator/UI_addEmployee.php">Employee Management</a></li>
            <li> <a href="../operator/UI_setDepartment.php">Department Management</a></li>
            <li> <a href="../operator/UI_schedule.php">Scheduling Management</a></li>
            <li> <a href="../operator/UI_payroll.php">Payroll Management</a></li>
            <li> <a href="../operator/UI_employeeSalary.php">Employee Salary Report</a></li>
            <li> <a href="../operator/UI_payslipReport.php">Payslip Report/Print</a></li>
            <li> <a href="../operator/UI_companyReport.php">Company Report</a></li>
        </ul>

    </div>

    <!-- END DASHBOARD -->
    <?php
    $activeForm = true;

    if (isset($_POST['search_e'])) {
        $activeForm = false;

        $search = $_POST["search_E_ID"];
        $sql = "SELECT * FROM `employee` WHERE employee_id = ? AND isActive = 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$search]);

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch()) {

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


            <form action="UI_addEmployee.php" method="post">

                <div class="search-engine">
                    <input placeholder="Search Employee ID" type="number" name="search_E_ID" id="search_E_ID">

                    <button type="submit" name="search_e" id="search_e">-></button>
                </div>
            </form>

            <div class="container2">
                <form action="../php/process.php" method="post">


                    <label>
                        <input type="number" name="E_ID" id="E_ID" value="<?php echo $E_ID; ?>"><br>
                        E_ID:
                    </label>



                    <input type="text" name="fname" id="fname" value="<?php echo $fname; ?>"><br>
                    <label>First Name:</label>


                    <input type="text" name="mi" id="mi" value="<?php echo $mi; ?>"><br>
                    <label>M.I:</label>


                    <input type="text" name="lname" id="lname" value="<?php echo $lname; ?>"><br>
                    <label>Last Name:</label>


                    <input type="number" name="age" id="age" value="<?php echo $age; ?>"><br>
                    <label>Age:</label>
            </div>

            <input type="email" name="email" id="email" value="<?php echo $email; ?>"><br>
            <label>Email:</label>
        </div>

        <input type="number" name="contact" id="contact" value="<?php echo $contact; ?>"><br>
        <label>Contact:</label>
        </div>


        <input type="date" name="date" id="date" value="<?php echo $date; ?>"><br>
        <label>Date Hired:</label>
        </div>


        <select name="gender" id="gender" value="<?php echo $gender; ?>">
            <label>Gender:</label>
            <option selected readonly value="<?php echo $gender; ?>">Current: <?php echo $gender; ?></option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>

        </div>

        <div class="container-content-select1">
            <label>Employee Stats:</label>
            <select name="stats" id="stats">
                <option selected readonly value="<?php echo $stats; ?>">Current: <?php echo $stats; ?></option>
                <option value="Regular">Regular</option>
                <option value="Contructual">Contructual</option>
            </select>

        </div>



        <button disabled class="save" type="submit" name="addEmployee">Save</button>
        <button type="submit" name="editEmployee">Update</button>
        <button type="submit" name="deleteEmployee">Delete</button>
        </div>

        </form>
        </div>
        </div>




        <!------------------------------------------ TABLE BELOW IS FOR SHOWING DATA FROM DATABASE ADD EMPLOYEE MODULE ---------------------------------------->

        <div class="table">
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

                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch()) {
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
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>

    <?php
    }

    if ($activeForm) {

    ?>
        <!-- -------------------------------------------------------------------------------------------------------------------------------------------- -->
        <div class="container">


            <form action="UI_addEmployee.php" method="post">
                <!-- form search-->
                <div class="search-engine">
                    <input placeholder="Search Employee ID" type="number" name="search_E_ID" id="search_E_ID">

                    <button type="submit" name="search_e" id="search_e">-></button>
                </div>
            </form>

            <div class="container2">
                <form action="../php/process.php" method="post">
                    <!-- form -->
                    <label>
                        <input type="number" name="E_ID" id="E_ID" required><br>
                        E_ID:
                    </label>
                    <label>
                        <input type="text" name="fname" id="fname" required><br>
                        First Name:
                    </label>
                    <label>
                        <input type="text" name="mi" id="mi" required><br>
                        M.I:
                    </label>
                    <label>
                        <input type="text" name="lname" id="lname" required><br>
                        Last Name:
                    </label>
                    <label>
                        <input type="number" name="age" id="age" required><br>
                        Age:
                    </label>
                    <label>
                        <input type="email" name="email" id="email" required><br>
                        Email:
                    </label>
                    <label>
                        <input type="number" name="contact" id="contact" required><br>
                        Contact:
                    </label>
                    <label>
                        <input type="date" name="date" id="date" required><br>
                        Date Hired:
                    </label>

                    <select name="gender" id="gender" required>
                        <label>Gender:</label>
                        <option selected disabled value="">- Gender -</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>

                    <label>Employee Stats:</label>
                    <select name="stats" id="stats" required>
                        <option selected disabled value="">Select</option>
                        <option value="Regular">Regular</option>
                        <option value="Contructual">Contructual</option>
                    </select>

                    <button class="save" type="submit" name="addEmployee">Save</button>
                    <button disabled="disabled">Update</button>
                    <button disabled="disabled">Delete</button>


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

                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch()) {
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
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>

    <?php } ?>

</body>

</html>