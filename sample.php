<!DOCTYPE html>
<html>
<head>
    <title>Sunday only</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

    <form action="" method="post">
        <label class="btn btn-primary">
        <input type="radio" required name="cutOff" value="weekly">Weekly</label>
        <label class="btn btn-primary">
        <input type="radio" required name="cutOff" value="Half-A-Month">Half A Month</label>
        <button type="submit" class="btn btn-success" name="submit" >Go</button>
    </form>

    <?php
        if(isset($_POST['submit'])){
            $cutOff = $_POST['cutOff'];

            if($cutOff == "weekly"){
                echo "pogi Ako";

                ?>

  
            <div class="container">
                    <form action="p.php" method="post">
                    <label> Select date start </label>
                    <input readonly name="date" id="date1" class=" datepicker" autocomplete="off">
                    <button type="submit" name="submit" class="btn btn-primary btn-sm" onclick="datePassing()" id="Getdate">Go</button>
                    </form>
            </div>

            <div class="container">
                <label>Date from:</label>
                <input type="date" readonly name="d_from" value="<?php echo $Date ;?>"><br>
                <label>Date to:</label>
                <input type="date" readonly name="d_to" value="<?php echo $date2 ;?>"> 
            </div>

        
<?php 
                    
                }
        }
?>



    

</body>
   
    <script type="text/javascript">
        $('.datepicker').datepicker({
            daysOfWeekDisabled: [1,2,3,4,5,6]
        });

        /**  
        * 
        * @param {number} period
        */
        
        // function datePassing (){
        //     var d1 = document.getElementById("date1").value;
        //     const addDays = (d1, period) => {
        //         d1.setDate(d1.getDate() + period);
        //     };

        //     let date = new Date();
        //     document.getElementById("daysWork").innerHTML=date;
        // }
    </script>
</html>