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
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/proper-placement.css">
    <link rel="stylesheet" href="../css/default.css">
    <title>Payroll Management</title>


    <script>
        function show() {
            document.getElementById('navigation').classList.toggle('active');
        }
    </script>

</head>

<body>
    <!-- DASHBOARD -->

    <div id="navigation">

        <div class="toggle-btn" onclick="show()">
            <span></span>
            <span></span>
            <span></span>
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
    <header class="tophead">
        <!-- <p>top head</p> -->
        <?php

        if (isset($_SESSION['User'])) {
            echo '<h1>' . 'WELCOME TO PAYROLL MANAGEMENT' . '</h1>';
            echo '<a href="logout_OP.php?logout">Logout</a>';
        } else {
            header("location:../index_OP.php");
        }

        ?>
    </header>
    <!------------------------------------------ END DASHBOARD ---------------------------------------->
    <div class="container container-style">
        <form action="UI_addEmployee.php" method="post">
            <!-- form search-->
            <div class="search-bg">
                <div class="search">
                    <input class="input-style search-style" placeholder="Search Employee ID" type="number" name="search_E_ID" id="search_E_ID">
                    <button type="submit" name="search_e" id="search_e"><i class='bx bx-search bx-margin'></i></button>
                </div>
            </div>
        </form>
        <form action="../php/process.php" method="post">
            <!-- form -->

            <label>
                <input class="input-style" type="text" name="fname" id="fname" required>
                <p>First Name</p>
            </label>
            <label>
                <input class="input-style" type="text" name="mi" id="mi" required>
                <p>Middle Initial</p>
            </label>
            <label>
                <input class="input-style" type="text" name="lname" id="lname" required>
                <p>Last Name</p>
            </label>
            <label>
                <input class="input-style removearrow" type="number" name="age" id="age" required>
                <p>Age</p>
            </label>
            <label>
                <input class="input-style" type="email" name="email" id="email" required>
                <p>Email</p>
            </label>
            <label>
                <input class="input-style removearrow" type="number" name="contact" id="contact" required>
                <p>Contact</p>
            </label>
            <label>
                <input class="input-style" type="date" name="date" id="date" required>
                <p>Data Hired</p>
            </label><br>
            <label class="side-left">
                Gender:
                <select class="option-size" name="" id="gender" required>
                    <option selected hidden value="">- Gender -</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </label>
            <label class="options-right">Employee Stats:
                <select class="option-size" name="stats" id="stats" required>
                    <option selected hidden value="">Select</option>
                    <option value="Regular">Regular</option>
                    <option value="Contructual">Contructual</option>
                </select>
            </label><br>

            <label class="b1">Over Time
                <input class="b-size" type="number" name="Text" id="Text" required>
            </label>
            <label class="b2">Allowance
                <input class="b-size" type="number" name="" id="" required>
            </label>
            <label class="b3">Holidays Work
                <input class="b-size" type="number" name="" id="" required>
            </label>
            <label class="b4">Leave Days
                <input class="b-size" type="number" name="" id="" required>
            </label>
            <label class="b5">SSS
                <input class="b-size" type="number" name="" id="" required>
            </label>
            <label class="b6">Pag-ibig
                <input class="b-size" type="number" name="" id="" required>
            </label>
            <label class="b7">Phil-Health
                <input class="b-size" type="number" name="" id="" required>
            </label>
            <label class="b8">SSS-Loan
                <input class="b-size" type="number" name="" id="" required>
            </label>
            <label class="b9">Pag-ibig loan
                <input class="b-size" type="number" name="" id="" required>
            </label>
            <label class="b10">Phil-Health Loan
                <input class="b-size" type="number" name="" id="" required>
            </label>
            <label class="b11">Others
                <input class="b11-size" type="Text" name="" id="" required>
            </label>
            <label class="b12">Deduction Total
                <input class="b12-size" type="number" name="" id="" required>
            </label>

            <button class="button save" type="submit" name="addEmployee">Save</button>
            <button class="button" disabled="disabled">Update</button>
            <button class="button" disabled="disabled">Delete</button>


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
    </div>

</body>


</html>