<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title> Haysst </title>
</head>
<body>
    <form action="" method="post">
        <input type="radio" name="cut" value="weekly" id="" required >Weekly
        <input type="radio" name="cut" value="halfMonth" id="" required >half A Month
        <button type="submit" name="btnCut">**</button>
    </form>
    <br>
    <hr>
    <br>

    <?php 
        if(isset($_POST['btnCut'])){
            $cutOff = $_POST['cut'];

            if($cutOff == "weekly"){
    ?>
                
                <label>DATE FROM:</label>
                <input type="date" name="from" id="dateFrom" style="margin-bottom: 10px;">
                <br>
                <label>DATE TO:</label>    
                <input type="date" name="to" id="dateTo" readonly>
                <button onclick="dateManipulateWeek()">**</button>   <!-- Button Here -->
                <hr>
                <label><input type="checkbox" name="" id="out1"> <span> SUN </span> </label>   <input type="time" name="" id="T_I1" style="margin-left: 10px;">   <input type="time" name="" id="T_O1">   <br>
                <label><input type="checkbox" name="" id="out2"> <span> MON </span> </label>   <input type="time" name="" id="T_I2" style="margin-left: 10px;">   <input type="time" name="" id="T_O2">   <br>
                <label><input type="checkbox" name="" id="out3"> <span> TUE </span> </label>   <input type="time" name="" id="T_I3" style="margin-left: 10px;">   <input type="time" name="" id="T_O3">   <br>
                <label><input type="checkbox" name="" id="out4"> <span> WED </span> </label>   <input type="time" name="" id="T_I4" style="margin-left: 10px;">   <input type="time" name="" id="T_O4">   <button onclick="set_allTime()">**</button>   <br>
                <label><input type="checkbox" name="" id="out5"> <span> THU </span> </label>   <input type="time" name="" id="T_I5" style="margin-left: 10px;">   <input type="time" name="" id="T_O5">   <br>
                <label><input type="checkbox" name="" id="out6"> <span> FRI </span> </label>   <input type="time" name="" id="T_I6" style="margin-left: 10px;">   <input type="time" name="" id="T_O6">   <br>
                <label><input type="checkbox" name="" id="out7"> <span> SAT </span> </label>   <input type="time" name="" id="T_I7" style="margin-left: 10px;">   <input type="time" name="" id="T_O7">   <br>
                <button onclick="weeklyBTN()" >Submit</button>
 
    <?php } elseif($cutOff == "halfMonth"){   //  end of if ($cutOff == weekly) -->
        ?>  

                <label>DATE FROM:</label>
                <input type="date" name="from" id="dateFrom" style="margin-bottom: 10px;">
                <br>
                <label>DATE TO:</label>    
                <input type="date" name="to" id="dateTo" readonly>
                <button onclick="dateManipulateMonth()">**</button>     <!-- Button Here -->
                <hr>
                <label><input type="checkbox" name="" id="out1"> <span> SUN </span> </label>   <input type="time" name="" id="T_I1" style="margin-left: 10px;">   <input type="time" name="" id="T_O1">   <br>
                <label><input type="checkbox" name="" id="out2"> <span> MON </span> </label>   <input type="time" name="" id="T_I2" style="margin-left: 10px;">   <input type="time" name="" id="T_O2">   <br>
                <label><input type="checkbox" name="" id="out3"> <span> TUE </span> </label>   <input type="time" name="" id="T_I3" style="margin-left: 10px;">   <input type="time" name="" id="T_O3">   <br>
                <label><input type="checkbox" name="" id="out4"> <span> WED </span> </label>   <input type="time" name="" id="T_I4" style="margin-left: 10px;">   <input type="time" name="" id="T_O4">   <button onclick="set_allTime()">**</button>   <br>
                <label><input type="checkbox" name="" id="out5"> <span> THU </span> </label>   <input type="time" name="" id="T_I5" style="margin-left: 10px;">   <input type="time" name="" id="T_O5">   <br>
                <label><input type="checkbox" name="" id="out6"> <span> FRI </span> </label>   <input type="time" name="" id="T_I6" style="margin-left: 10px;">   <input type="time" name="" id="T_O6">   <br>
                <label><input type="checkbox" name="" id="out7"> <span> SAT </span> </label>   <input type="time" name="" id="T_I7" style="margin-left: 10px;">   <input type="time" name="" id="T_O7">   <br>
                <button onclick="haftMonthBTN()" >Submit</button>

        <?php } ?> <!-- end of elseif ($cutOff == halfMonth) -->
          
    <?php } ?>

  <script>

      function dateManipulateWeek (){   // For show day add (weekly) 
        first = new Date($('#dateFrom').val());
        // console.log(first);
        output = new Date(first.setDate(first.getDate()+6)).toISOString().split('.');
        output7 = output[0].split('T');
        $('#dateTo').val(output7[0]);   // show to date to automatic
         // show data in checkbox
      }

      function dateManipulateMonth (){   // For show day add (Half Month)
        first = new Date($('#dateFrom').val());
        // console.log(first);
        output = new Date(first.setDate(first.getDate()+14)).toISOString().split('.');
        output7 = output[0].split('T');
        $('#dateTo').val(output7[0]);   // show to date to automatic
         // show data in checkbox
      }

      function set_allTime(){   // for set all same time in time out
        const timeIN = document.getElementById('T_I1').value;
        const timeOUT = document.getElementById('T_O1').value;

        // Time in set all
        document.getElementById('T_I2').value=timeIN;
        document.getElementById('T_I3').value=timeIN;
        document.getElementById('T_I4').value=timeIN;
        document.getElementById('T_I5').value=timeIN;
        document.getElementById('T_I6').value=timeIN;
        document.getElementById('T_I7').value=timeIN;
        // time out set all
        document.getElementById('T_O2').value=timeOUT;
        document.getElementById('T_O3').value=timeOUT;
        document.getElementById('T_O4').value=timeOUT;
        document.getElementById('T_O5').value=timeOUT;
        document.getElementById('T_O6').value=timeOUT;
        document.getElementById('T_O7').value=timeOUT;
      }

      $('#dateFrom').datepicker({ minDate: 4,beforeShowDay: $.datepicker.noWeekends });

      

  </script>



</body>
</html>