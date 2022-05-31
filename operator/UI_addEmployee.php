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
    <!-- <link rel="stylesheet" href="../css/login.css"> -->
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
            <div class="title">
                <h1 class="t-left">SymTech</h1>
                <h1 class="dot">.</h1>
            </div>
        <!-- <div id="nav">
            <div class="toggle-btn" onclick="show()">
                <span class="line top"></span>
                <span class="line middle"></span>
                <span class="line buttom"></span>
            </div>
        </div> -->
        <ul>
            <li>
                <a href="#">
                    <!-- <i class='bx bx-bar-chart-square bx-flip-horizontal' style='color:#ffffff'  ></i> -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="float: left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="M3 5v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2H5c-1.103 0-2 .897-2 2zm16.001 14H5V5h14l.001 14z"></path><path d="M11 7h2v10h-2zm4 3h2v7h-2zm-8 2h2v5H7z"></path></svg>
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a href="../operator/UI_addEmployee.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="float:left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="M15 11h7v2h-7zm1 4h6v2h-6zm-2-8h8v2h-8zM4 19h10v-1c0-2.757-2.243-5-5-5H7c-2.757 0-5 2.243-5 5v1h2zm4-7c1.995 0 3.5-1.505 3.5-3.5S9.995 5 8 5 4.5 6.505 4.5 8.5 6.005 12 8 12z"></path></svg>
                    <p>Employee Management</p>
                </a>

            </li>
            <li>
                <a href="../operator/UI_setDepartment.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="float:left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="M7 14.001h2v2H7z"></path><path d="M19 2h-8a2 2 0 0 0-2 2v6H5c-1.103 0-2 .897-2 2v9a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2zM5 20v-8h6v8H5zm9-12h-2V6h2v2zm4 8h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V6h2v2z"></path></svg>
                    <p>Department Management</p>
                </a>
            </li>
            <li>
                <a href="../operator/UI_schedule.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="float:left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="M21 20V6c0-1.103-.897-2-2-2h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2zM9 18H7v-2h2v2zm0-4H7v-2h2v2zm4 4h-2v-2h2v2zm0-4h-2v-2h2v2zm4 4h-2v-2h2v2zm0-4h-2v-2h2v2zm2-5H5V7h14v2z"></path></svg>
                    <p>Scheduling Management</p>
                </a>
            </li>
            <li>
                <a href="../operator/UI_payroll.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="float:left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="M20 6c0-2.168-3.663-4-8-4S4 3.832 4 6v2c0 2.168 3.663 4 8 4s8-1.832 8-4V6zm-8 13c-4.337 0-8-1.832-8-4v3c0 2.168 3.663 4 8 4s8-1.832 8-4v-3c0 2.168-3.663 4-8 4z"></path><path d="M20 10c0 2.168-3.663 4-8 4s-8-1.832-8-4v3c0 2.168 3.663 4 8 4s8-1.832 8-4v-3z"></path></svg>
                    <p>Payroll Management</p>
                    <!-- style="float:left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1); -->
                </a>
            </li>
            <li>
                <a href="../operator/UI_employeeSalary.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="float:left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="M20 3H4c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zM4 19V5h16l.002 14H4z"></path><path d="M6 7h12v2H6zm0 4h12v2H6zm0 4h6v2H6z"></path></svg>
                    <p>Employee Salary Report</p>
                </a>
            </li>
            <li>
                <a href="../operator/UI_payslipReport.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="float:left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="m12 16 4-5h-3V4h-2v7H8z"></path><path d="M20 18H4v-7H2v7c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2v-7h-2v7z"></path></svg>
                    <p>Payslip Report/Print</p>
                </a>
            </li>
            <li>
                <a href="../operator/UI_companyReport.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="float:left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="M5 3H3v18h18v-2H5z"></path><path d="M13 12.586 8.707 8.293 7.293 9.707 13 15.414l3-3 4.293 4.293 1.414-1.414L16 9.586z"></path></svg>
                    <p>Company Report</p>
                </a>
            </li>
        </ul>

    </div>

    <!-- END DASHBOARD -->
    <header class="tophead">
        <!-- DITO MO LAGAY YUNG LOG OUT MO -->
    </header>
    <div class="banner">
        
    </div>
    <div class="container container-style container-medium">

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
                        <button type="submit" name="search_e" id="search_e"><i class='bx bx-margin bx-search'></i></button>
                    </div>
                </div>
            </form>

                <form action="../php/process.php" method="post">
                    <label>
                        <input class="input-style" type="number" name="E_ID" id="E_ID" value="<?php echo $E_ID; ?>">
                        <p>Employee ID</p>
                    </label>
                    <label>
                        <input class="input-style" type="text" name="fname" id="fname" value="<?php echo $fname; ?>">
                        <p>First Name</p>
                    </label>
                    <label>
                        <input class="input-style" type="text" name="mi" id="mi" value="<?php echo $mi; ?>">
                        <p>Middle Name</p>
                    </label>
                    <label>
                        <input class="input-style" type="text" name="lname" id="lname" value="<?php echo $lname; ?>">
                        <p>Last Name</p>
                    </label>
                    <label>
                        <input class="input-style" type="number" name="age" id="age" value="<?php echo $age; ?>">
                        <p>Age</p>
                    </label>
                    <label>
                        <input class="input-style" type="email" name="email" id="email" value="<?php echo $email; ?>">
                        <p>Email</p>
                    </label>
                    <label>
                        <input class="input-style" type="number" name="contact" id="contact" value="<?php echo $contact; ?>">
                        <p>Contact</p>
                    </label>
                    <label>
                        <input class="input-style" type="date" name="date" id="date" value="<?php echo $date; ?>">
                        <p>Date Hired</p>
                    </label><br>
                    <label class="side-left">
                        <select class="option-size" name="gender" id="gender" value="<?php echo $gender; ?>">
                            Gender:
                            <option selected hidden value="<?php echo $gender; ?>">Current: <?php echo $gender; ?></option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </label>
                    <label class="options-right">Employee Stats:
                        <select class="option-size" name="stats" id="stats">
                            <option selected hidden value="<?php echo $stats; ?>">Current: <?php echo $stats; ?></option>
                            <option value="Regular">Regular</option>
                            <option value="Contructual">Contructual</option>
                        </select>
                    </label>
                    <button class="button" disabled type="submit" name="addEmployee">Save</button>
                    <button class="button update" type="submit" name="editEmployee">Update</button>
                    <button class="button delete" type="submit" name="deleteEmployee">Delete</button>
                </form>
    </div>






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
                                $sql = "SELECT * FROM employee WHERE isActive = 1 AND user_type_id = 3;";
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
            // <!-- -------------------------------------------------------------------------------------------------------------------------------------------- -->

        if ($activeForm) {

        ?>


    
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
                <!-- <label>
                    <input class="input-style" type="number" name="E_ID" id="E_ID" required>
                    <p>Employee ID</p>
                </label> -->
                <label>
                    <input class="input-style" type="text" name="fname" id="fname" required>
                    <p>First Name</p>
                </label>
                <label>
                    <input class="input-style" type="text" name="mi" id="mi" required>
                    <p>Middle Name</p>
                </label>
                <label>
                    <input class="input-style" type="text" name="lname" id="lname" required>
                    <p>Last Name</p>
                </label>
                <label>
                    <input class="input-style" type="number" name="age" id="age" required>
                    <p>Age</p>
                </label>
                <label>
                    <input class="input-style" type="email" name="email" id="email" required>
                    <p>Email</p>
                </label>
                <label>
                    <input class="input-style" type="number" name="contact" id="contact" required>
                    <p>Contact</p>
                </label>
                <label>
                    <input class="input-style" type="date" name="date" id="date" required>
                    <p>Data Hired</p>
                </label><br>
                <label class="side-left">Gender:
                    <select class="option-size" name="gender" id="gender" required>
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
                    </label>
                    <button class="button save" type="submit" name="addEmployee">Save</button>
                    <button class="button" disabled="disabled">Update</button>
                    <button class="button" disabled="disabled">Delete</button>
                </label>
            </form>
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
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $pdo = $classPayroll->openConnection();
                        $sql = "SELECT * FROM employee WHERE isActive = 1 AND user_type_id = 3 ;";
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
                                    <td> <a href="#">Edit</a> <a href="#">Delete</a></td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    
</body>

</html>