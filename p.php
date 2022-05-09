<?php 


    if(isset($_POST['submit'])){
        $date = $_POST['date'];

        $date1 = date('D', strtotime($date))." ".$date." <br/>"; // Curent selected date
        $date2 = date('D', strtotime($date. '+ 1 days'))." ".date('m/d/yy', strtotime($date. '+ 1 days')) ." <br/>";
        $date3 = date('D', strtotime($date. '+ 2 days'))." ".date('m/d/yy', strtotime($date. '+ 2 days')) ." <br/>";
        $date4 = date('D', strtotime($date. '+ 3 days'))." ".date('m/d/yy', strtotime($date. '+ 3 days')) ." <br/>";
        $date5 = date('D', strtotime($date. '+ 4 days'))." ".date('m/d/yy', strtotime($date. '+ 4 days')) ." <br/>";
        $date6 = date('D', strtotime($date. '+ 5 days'))." ".date('m/d/yy', strtotime($date. '+ 5 days')) ." <br/>";
        $date7 = date('D', strtotime($date. '+ 6 days'))." ".date('m/d/yy', strtotime($date. '+ 6 days')) ." <br/>";


            header("location: sample.php?value=$date");
    }