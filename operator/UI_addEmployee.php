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
    <link rel="stylesheet" href="../css/proper-placement.css">
    <link rel="stylesheet" href="../css/default.css">
    <!-- <link rel="stylesheet" href="../css/UI_setDepartment.css"> -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
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

            <li>
                <a href="../operator/UI_addEmployee.php">
                    <i class='bx bxs-user-account'></i>
                    <p>Employee Management</p>
                </a>

            </li>
            <li>
                <a href="../operator/UI_setDepartment.php">
                    <i class='bx bxs-building-house'></i>
                    <p>Department Management</p>
                </a>
            </li>
            <li>
                <a href="../operator/UI_schedule.php">
                    <i class='bx bxs-calendar'></i>
                    <p>Scheduling Management</p>
                </a>
            </li>
            <li>
                <a href="../operator/UI_payroll.php">
                    <i class='bx bxs-data'></i>
                    <p>Payroll Management</p>
                </a>
            </li>
            <li>
                <a href="../operator/UI_employeeSalary.php">
                    <i class='bx bx-task'></i>
                    <p>Employee Salary Report</p>
                </a>
            </li>
            <li>
                <a href="../operator/UI_payslipReport.php">
                    <i class='bx bxs-report'></i>
                    <p>Payslip Report/Print</p>
                </a>
            </li>
            <li>
                <a href="../operator/UI_companyReport.php">
                    <i class='bx bx-line-chart-down'></i>
                    <p>Company Report</p>
                </a>
            </li>
        </ul>

    </div>

    <!-- END DASHBOARD -->
    <header class="tophead">
        <!-- DITO MO LAGAY YUNG LOG OUT MO -->
    </header>
    <!-- <div class="banner">
    </div> -->
    <div class="container container-style">

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



            <form action="UI_addEmployee.php" method="post">
                <div class="search-bg">
                    <div class="search">
                        <input class="input-style search-style" placeholder="Search Employee ID" type="number" name="search_E_ID" id="search_E_ID">
                        <button type="submit" name="search_e" id="search_e"><i class='bx bx-margin bx-search size'></i></button>
                    </div>
                </div>
                <form action="../php/process.php" method="post">
                    <label>
                        <input class="input-style" type="number" name="E_ID" id="E_ID" value="<?php echo $E_ID; ?>">
                        E_ID:
                    </label>
                    <label>
                        <input class="input-style" type="text" name="fname" id="fname" value="<?php echo $fname; ?>">
                        First Name:
                    </label>
                    <label>
                        <input class="input-style" type="text" name="mi" id="mi" value="<?php echo $mi; ?>">
                        M.I:
                    </label>
                    <label>
                        <input class="input-style" type="text" name="lname" id="lname" value="<?php echo $lname; ?>">
                        Last Name:
                    </label>
                    <label>
                        <input class="input-style" type="number" name="age" id="age" value="<?php echo $age; ?>">
                        Age:
                    </label>
                    <label>
                        <input class="input-style" type="email" name="email" id="email" value="<?php echo $email; ?>">
                        Email:
                    </label>
                    <label>
                        <input class="input-style" type="number" name="contact" id="contact" value="<?php echo $contact; ?>">
                        Contact:
                    </label>
                    <label>
                        <input class="input-style" type="date" name="date" id="date" value="<?php echo $date; ?>">
                        Date Hired:
                    </label>
                    <label>
                        <select name="gender" id="gender" value="<?php echo $gender; ?>">
                            Gender:
                            <option selected readonly value="<?php echo $gender; ?>">Current: <?php echo $gender; ?></option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </label>
                    <label>Employee Stats:
                        <select name="stats" id="stats">
                            <option selected readonly value="<?php echo $stats; ?>">Current: <?php echo $stats; ?></option>
                            <option value="Regular">Regular</option>
                            <option value="Contructual">Contructual</option>
                        </select>
                    </label>
                    <button disabled class="save" type="submit" name="addEmployee">Save</button>
                    <button type="submit" name="editEmployee">Update</button>
                    <button type="submit" name="deleteEmployee">Delete</button>








                    <!------------------------------------------ TABLE BELOW IS FOR SHOWING DATA FROM DATABASE ADD EMPLOYEE MODULE ---------------------------------------->

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
                </form>
            </form>


        <?php
        }
            // <!-- -------------------------------------------------------------------------------------------------------------------------------------------- -->

        if ($activeForm) {

        ?>



            <form action="UI_addEmployee.php" method="post">
                <!-- form search-->
                <div class="search-bg">
                    <div class="search">
                        <input class="input-style search-style" placeholder="Search Employee ID" type="number" name="search_E_ID" id="search_E_ID">
                        <button type="submit" name="search_e" id="search_e"><i class='bx bx-search size'></i></button>
                    </div>
                </div>
            </form>
            <form action="../php/process.php" method="post">
                <!-- form -->
                <label>
                    <input class="input-style" type="number" name="E_ID" id="E_ID" required>
                    E_ID:
                </label>
                <label>
                    <input class="input-style" type="text" name="fname" id="fname" required>
                    First Name:
                </label>
                <label>
                    <input class="input-style" type="text" name="mi" id="mi" required>
                    M.I:
                </label>
                <label>
                    <input class="input-style" type="text" name="lname" id="lname" required>
                    Last Name:
                </label>
                <label>
                    <input class="input-style" type="number" name="age" id="age" required>
                    Age:
                </label>
                <label>
                    <input class="input-style" type="email" name="email" id="email" required>
                    Email:
                </label>
                <label>
                    <input class="input-style" type="number" name="contact" id="contact" required>
                    Contact:
                </label>
                <label>
                    <input class="input-style" type="date" name="date" id="date" required>
                    Date Hired:
                </label>
                </label>
                <select name="gender" id="gender" required>
                    <option selected hidden value="">- Gender -</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <label>Gender:
                    <label>Employee Stats:
                        <select name="stats" id="stats" required>
                            <option selected hidden value="">Select</option>
                            <option value="Regular">Regular</option>
                            <option value="Contructual">Contructual</option>
                        </select>
                    </label>
                    <button class="save" type="submit" name="addEmployee">Save</button>
                    <button disabled="disabled">Update</button>
                    <button disabled="disabled">Delete</button>
                </label>

            </form>

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
    </div>
</body>

</html>