<?php

    class MyPayroll {

        private $server = "mysql:host=localhost;dbname=hr_payroll";
        private $user = "root";
        private $pass = "";   
        private $option = [
            PDO::ATTR_ERRMODE   =>   PDO::ERRMODE_EXCEPTION ,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        protected $conn;

// ---------------------------------------------------- OPEN CONNECTION ---------------------------------------------------- //

        public function openConnection()
        {    
            try 
            {
               $this->conn = new PDO($this->server, $this->user, $this->pass, $this->option);
                return $this->conn;

            }catch(PDOException $e)
            {
                echo "Error Connection :".$e->getMessage();
            }

        }

// ---------------------------------------------------- CLOSE CONNECTION ---------------------------------------------------- //

        public function closeConnection()
        {
            $this->conn = null;
        }

// ---------------------------------------------------- LOGIN ADMINISTRATOR ---------------------------------------------------- //

        public function loginAdmin()
        {


            try
            {
                if(isset($_POST['submit1']))
                {
                    $username = $_POST["username1"];
                    $password = $_POST["password1"];   
                

                    if($username == ("") && $password == (""))
                    {

                      
                        header("Location: dashboard.php");


                    } else {


                        echo ("<script LANGUAGE='JavaScript'> window.alert('Your username or password is incorrect...');  window.location.href='http://localhost/hr_payroll/index.php'; </script>");                        
                    
                    
                    }
                
                }
                throw new Exception();
            } catch (Exception $e) {
                echo $e->getMessage();
            }

        }

// ---------------------------------------------------- REGISTER OPERATOR ---------------------------------------------------- //

        public function register_op()
        {

            $pdo = $this->openConnection();
            if(isset($_POST['add_op']))
            {
                $email = $_POST["op_email"];
                $pass = md5($_POST["op_pass"]);
                $fname = $_POST["op_fn"];
                $mname = $_POST["op_mn"];
                $lname = $_POST["op_ln"];

                if($this->check_email_exist($email) == 0){
                    
                    $sql = " INSERT INTO operator (`op_email`, `op_password`, `op_fname`, `op_mname`, `op_lname`) VALUES (?,?,?,?,?);";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$email, $pass, $fname, $mname, $lname]);

                    echo ("<script LANGUAGE='JavaScript'> window.alert('Succesful Register');
                    window.location.href='http://localhost/hr_payroll/user_interface/dashboard.php'; </script>");

                } else {

                    echo ("<script LANGUAGE='JavaScript'> window.alert('Email is already exists ---->  Use other Email');
                    window.location.href='http://localhost/hr_payroll/user_interface/UI_register_OP.php'; </script>");

                }


            }

        
        }

// ---------------------------------------------------- LOGIN OPERATOR ---------------------------------------------------- //

        public function loginOperator()
        {
            
            if(isset($_POST['op_login']))
            {
                $username = $_POST["op_username"];
                $password = md5($_POST["op_password"]);  
                
                $pdo = $this->openConnection();
                $sql = ("SELECT * FROM operator WHERE op_email = ? AND op_password = ?");
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$username, $password]);
                $total = $stmt->rowCount();

                if($total > 0)
                {

                    
                    echo ("<script LANGUAGE='JavaScript'> window.alert('Login Operator Successful');
                    window.location.href='http://localhost/hr_payroll/user_interface/UI_addEmployee.php'; </script>");
                
                
                } else {   


                    echo ("<script LANGUAGE='JavaScript'> window.alert('Login Operator FAILED!');
                    window.location.href='http://localhost/hr_payroll/user_interface/UI_login_OP.php'; </script>");


                }

            } 

        } 


// ---------------------------------------------------- CHECK EMAIL IF EXIST ---------------------------------------------------- //

        public function check_email_exist($email)
        {

            $pdo = $this->openConnection();
            $sql = ("SELECT * FROM operator WHERE op_email = ? ");
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email]);
            $total = $stmt->rowCount();

            return $total;
        }

// ---------------------------------------------------- ADDING SESSION ---------------------------------------------------- //

    // add employee --   
        public function addEmployee()
        {
            $pdo = $this->openConnection();
            if(isset($_POST['addEmployee']))
            {
                $E_ID = $_POST["E_ID"];
                $fname = $_POST["fname"];
                $mi = $_POST["mi"];
                $lname = $_POST["lname"];
                $age = $_POST["age"];
                $email = $_POST["email"];
                $contact = $_POST["contact"];
                $gender = $_POST["gender"];
                $stats = $_POST["stats"];
                $date = $_POST["date"];
        
                $sql = "INSERT INTO employee (employee_id, first_name, middle_in, last_name, age, email, contact, gender, stats, date_hired) VALUES (?,?,?,?,?,?,?,?,?,?);";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$E_ID, $fname, $mi, $lname, $age, $email, $contact, $gender, $stats, $date]);

                header('location: ../user_interface/UI_setDepartment.php');
            }
        
        }

    // set Department --
        public function setDepartment()
        {
            echo "Dito ako nag stop mag codes";
        }

// ---------------------------------------------------- UPDATE SESSION ---------------------------------------------------- //

        public function update_employee_module()
        {
            $pdo = $this->openConnection();
            if(isset($_POST['editEmployee']))
            {
                $E_ID = $_POST["E_ID"];
                $fname = $_POST["fname"];
                $mi = $_POST["mi"];
                $lname = $_POST["lname"];
                $age = $_POST["age"];
                $email = $_POST["email"];
                $contact = $_POST["contact"];
                $gender = $_POST["gender"];
                $stats = $_POST["stats"];
                $date = $_POST["date"];
            
                $sql = "UPDATE employee SET first_name = ?, middle_in = ?, last_name = ?, age = ?, email = ?, contact = ?, gender = ?, stats = ?, date_hired = ?
                WHERE employee_id = ?;";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([ $fname, $mi, $lname, $age, $email, $contact, $gender, $stats, $date, $E_ID]);
            
              
            } 

        }

// ---------------------------------------------------- DELETE SESSION ---------------------------------------------------- //

        public function delete_employee_module()
        {
            $pdo = $this->openConnection(); 
            
            
            if(isset($_POST['deleteEmployee']))
            {
                 // Soft Deletion
                 $E_ID = $_POST["E_ID"];
                 $sql = "UPDATE employee SET isActive = 0 WHERE employee_id = ?;";
                 $stmt = $pdo->prepare($sql);
                 $stmt->execute([$E_ID]);

                 header("Location: ../user_interface/UI_addEmployee.php");
                //  echo ("<script LANGUAGE='JavaScript'>window.location.href='http://localhost/hr_payroll/user_interface/UI_addEmployee.php'; </script>");  
            }    // Hard Deletion
                // $E_ID = $_POST["E_ID"];
                // $sql = "DELETE FROM users WHERE userID = ?;";
                // $stmt = $pdo->prepare($sql);
                // $stmt->execute([$E_ID]);           
                // header("Location: ../user_interface/UI_addEmployee.php");
        }

    }

$classPayroll = new MyPayroll();

