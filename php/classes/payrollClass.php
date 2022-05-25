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
            $pdo = $this->openConnection();
            session_start();

            
            try
            { 
                if(isset($_POST['submit1']))
                {
                    
                    $username = $_POST["username1"];
                    $password = $_POST["password1"];   
                
                    if(empty($username) || empty($password))
                    {
                         header("location:index_AD.php?Empty= Please Fill in the Blanks");
                    }

                    else
                    {
                        $sql = "SELECT * FROM `admin` WHERE email_ad = ? AND pass_ad = ?";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([$username,$password]);
            
                        if($stmt->fetch())
                        {
                            $_SESSION['User'] = $username;
                            header("location:admin/UI_dashboard_ad.php");
                        }
                        else
                        {
                            header("location:index_AD.php?Invalid= Please Enter Correct User Name and Password ");
                        }
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
                $fname = $_POST["op_fn"];
                $mname = $_POST["op_mn"];
                $lname = $_POST["op_ln"];
                $email = $_POST["op_email"];
                 $pass = md5($_POST["op_pass"]);
                $user_type = "2" ; 

                if($this->check_email_exist($email) == 0){
                    
                    $sql = " INSERT INTO employee (`first_name`, `middle_in`, `last_name`, `email`, `password`, `user_type_id`) VALUES (?,?,?,?,?,?);";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$fname, $mname, $lname, $email, $pass, $user_type]);

                    echo ("<script LANGUAGE='JavaScript'> window.alert('Succesful Register');
                    window.location.href='../admin/UI_dashboard_ad.php'; </script>");

                } else {

                    echo ("<script LANGUAGE='JavaScript'> window.alert('Email is already exists ---->  Use other Email');
                    window.location.href='../admin/UI_register_OP.php'; </script>");

                }


            }

        
        }

// ---------------------------------------------------- LOGIN OPERATOR ---------------------------------------------------- //

        public function loginOperator()
        {
            $pdo = $this->openConnection();
            session_start();

            if(isset($_POST['op_login']))
            {
                $username = $_POST["op_username"];
                $password = $_POST["op_password"];
                // $password = md5($_POST["op_password"]);
                
                if(empty($username) || empty($password))
                {
                    header("location:index_OP.php?Empty= Please Fill in the Blanks");
                }
                
                else
                {
                    $sql = ("SELECT * FROM operator WHERE email_op = ? AND password_op = ?");
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$username,$password]);
        
                    if($row = $stmt->fetch())
                    {
                        $_SESSION['User'] = $row['fname_op'];
                        header("location:operator/welcome_OP.php");
                    }
                    else
                    {
                        header("location:index_OP.php?Invalid= Please Enter Correct User Name and Password ");
                    }
               }
            }

        } 

// ---------------------------------------------------- LOGIN USERS ---------------------------------------------------- // 

        public function loginUsers()
        {
            $pdo = $this->openConnection();
            session_start();

            if(isset($_POST['login']))
            {
                $username = $_POST["username"];
                $password = $_POST["password"];
                
                if(empty($username) || empty($password))
                {

                    header("location:index.php?Empty= Please Fill in the Blanks");

                } else {

                    $sql = "SELECT * FROM users WHERE email_addr = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$username]);
        
                    if($stmt->rowCount() > 0){
                        while($row = $stmt->fetch()){

                            $_SESSION['User'] = $row['first_name'];

                            if(($row['user_type'] == 2) && ($row['password'] == md5($password))){

                                header("location: operator/welcome_op.php");

                            } elseif(($row['user_type'] == 1) && ($row['password'] == $password)){

                                header("location: admin/UI_dashboard_ad.php");

                            } elseif(($row['user_type'] == 3) && ($row['password'] == $password)){

                                header("location: employee/welcome_employee.php");

                            }
                            
                            else {
                                header("location:index.php?Invalid= Please Enter Correct User Name and Password ");
                            }

                            // if($row['user_type'] == '1'){
                            //     header("location: admin/UI_dashboard_ad.php");   
                            // }elseif($row['user_type'] == '2'){
                                
                            // }

                        }
                    }
                    else
                    {
                        header("location:index.php?Invalid= Please Enter Correct User Name and Password ");
                    }
               }
            }

            

        }


// ---------------------------------------------------- CHECK EMAIL IF EXIST ---------------------------------------------------- //

        public function check_email_exist($email)
        {

            $pdo = $this->openConnection();
            $sql = ("SELECT * FROM users WHERE email_addr = ? ");
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
                $password = "#".substr($lname,0,2)."8080";
                $user_type_id = '3';

            
                // code here kapag may parehas di tutuloy
                if(empty($this->check_email_exist($email))){

                    $sql = "INSERT INTO employee (first_name, middle_in, last_name, age, email, `password`, contact, gender, stats, date_hired, user_type_id) VALUES (?,?,?,?,?,?,?,?,?,?,?);";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$fname, $mi, $lname, $age, $email, $password, $contact, $gender, $stats, $date, $user_type_id]);

                // $sql = "INSERT INTO users ( first_name, middle_name, surname, email_addr, password,  user_type) VALUES (?,?,?,?,?,?);";
                // $stmt = $pdo->prepare($sql);
                // $stmt->execute([$fname, $mi, $lname, $email, $password, $user_type ]);

                    echo ("<script LANGUAGE='JavaScript'> window.alert('Succesful Register');
                    window.location.href='../operator/ui_addemployee'; </script>");

                } else  {
                    header("location: ../operator/ui_addemployee.php");
                    echo "Email Exist";
    
                }

            } 
        
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

                // $sql = "UPDATE users SET first_name = ?, middle_in = ?, last_name = ?, email = ?, WHERE employee_id = ?;";
                // $stmt = $pdo->prepare($sql);
                // $stmt->execute([ $fname, $mi, $lname, $email, $E_ID]);
            
                echo ("<script LANGUAGE='JavaScript'> window.alert('Successfully Update Credentials..');
                window.location.href='../operator/UI_addEmployee.php'; </script>");
              
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

                 header("Location: ../operator/UI_addEmployee.php");
                //  echo ("<script LANGUAGE='JavaScript'>window.location.href='http://localhost/hr_payroll/operator/UI_addEmployee.php'; </script>");  
            }    // Hard Deletion
                // $E_ID = $_POST["E_ID"];
                // $sql = "DELETE FROM users WHERE userID = ?;";
                // $stmt = $pdo->prepare($sql);
                // $stmt->execute([$E_ID]);           
                // header("Location: ../operator/UI_addEmployee.php");
        }

    }

$classPayroll = new MyPayroll();

