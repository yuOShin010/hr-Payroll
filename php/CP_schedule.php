<?php


    if(isset($_POST['computeDays'])){
        $d_from = $_POST['d_from'];
        $d_to = $_POST['d_to'];
            // Declare two dates
        $start_date = strtotime($d_from);
        $end_date = strtotime($d_to);
        
        // Get the difference and divide into
        // total no. seconds 60/60/24 to get
        // number of days
        // echo "Difference between two dates: "
        //     . ($end_date - $start_date)/60/60/24;
        
        }