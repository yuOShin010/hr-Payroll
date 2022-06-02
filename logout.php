<!DOCTYPE html>
<html lang="en">
<head>
    <script src="sweet_alert/jquery-3.6.0.min.js"></script>
    <script src="sweet_alert/sweetalert2.all.min.js"></script>
    <title>Logout</title>
</head>
<body>
    
<?php 
    session_start();
    if(isset($_GET['logout']))
    {
        session_unset();
        if(session_unset()){
                echo    "<script>";
                echo    "Swal.fire({
                            icon: 'success',
                            title: 'Signing out',
                            text: 'Thanks you for using Team-J website',
                            showConfirmButton: false,
                            timer: 3000
                        }).then((result) => {
                            if(result) {
                                window.location.href='index.php';
                            }
                        });";
                echo    "</script>";
        }
        // session_unset();
        // header("location:index.php");
    }

?>
</body>
</html>