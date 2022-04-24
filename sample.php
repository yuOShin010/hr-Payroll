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
   
<div class="container">
   <form action="sample.php" method="post">
  Select date start <input readonly name="date" class=" datepicker" autocomplete="off">
  <button type="submit" name="submit" class="btn btn-primary btn-sm">asdasd</button>
  </form>
</div>



   <div class="container">

    <?php if(isset($_POST['submit'])){
            $date= $_POST['date'];

            echo date('D', strtotime($date))." ".$date." <br/>";
            echo date('D', strtotime($date. '+ 1 days'))." ".date('m/d/yy', strtotime($date. '+ 1 days')) ." <br/>";
            echo date('D', strtotime($date. '+ 2 days'))." ".date('m/d/yy', strtotime($date. '+ 2 days')) ." <br/>";
            echo date('D', strtotime($date. '+ 3 days'))." ".date('m/d/yy', strtotime($date. '+ 3 days')) ." <br/>";
            echo date('D', strtotime($date. '+ 4 days'))." ".date('m/d/yy', strtotime($date. '+ 4 days')) ." <br/>";
            echo date('D', strtotime($date. '+ 5 days'))." ".date('m/d/yy', strtotime($date. '+ 5 days')) ." <br/>";
            echo date('D', strtotime($date. '+ 6 days'))." ".date('m/d/yy', strtotime($date. '+ 6 days')) ." <br/>";
     
        
    ?>
    </div>

    <div class=" btn-group-vertical" data-toggle="buttons">
                    <label class="btn btn-primary">
                        <input type="checkbox" autocomplete="off">
                        <?php echo date('D', strtotime($date))." ".$date." <br/>";?>
                    </label>

                    <label class="btn btn-primary">
                        <input type="checkbox" autocomplete="off" >
                        <?php echo date('D', strtotime($date. '+ 1 days'))." ".date('m/d/yy', strtotime($date. '+ 1 days')) ." <br/>";?>
                    </label>

                    <label class="btn btn-primary">
                        <input type="checkbox" autocomplete="off">
                        <?php echo date('D', strtotime($date. '+ 2 days'))." ".date('m/d/yy', strtotime($date. '+ 2 days')) ." <br/>";?>
                    </label>
                    <label class="btn btn-primary">
                        <input type="checkbox" autocomplete="off">
                        <?php  echo date('D', strtotime($date. '+ 3 days'))." ".date('m/d/yy', strtotime($date. '+ 3 days')) ." <br/>";?>
                    </label>

                    <label class="btn btn-primary">
                        <input type="checkbox" autocomplete="off" >
                        <?php echo date('D', strtotime($date. '+ 4 days'))." ".date('m/d/yy', strtotime($date. '+ 4 days')) ." <br/>";?>
                    </label>

                    <label class="btn btn-primary">
                        <input type="checkbox" autocomplete="off">
                        <?php echo date('D', strtotime($date. '+ 5 days'))." ".date('m/d/yy', strtotime($date. '+ 5 days')) ." <br/>";?>
                    </label>

                    <label class="btn btn-primary">
                        <input type="checkbox" autocomplete="off">
                        <?php echo date('D', strtotime($date. '+ 6 days'))." ".date('m/d/yy', strtotime($date. '+ 6 days')) ." <br/>";?>
                    </label>
                </div>

                <?php } ?>

</body>
   
    <script type="text/javascript">
        $('.datepicker').datepicker({
            daysOfWeekDisabled: [1,2,3,4,5,6]
        });
    </script>
</html>