<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/UI_setDepartment.css">
    <script type="text/javascript" src="test.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <title>Schedule | Symtech</title>
</head>
<body>
    <form action="" method="post">
        <label class="btn btn-primary">
        <input type="radio" required name="cutOff" id="cutOff" value="weekly">Weekly</label>
        <label class="btn btn-primary">
        <input type="radio" required name="cutOff" id="cutOff" value="Half-A-Month">Half A Month</label>
        <button type="submit" class="btn btn-success" name="submit" id="submit">Go</button>
    </form>

    <?php
        if(isset($_POST['submit'])){
            $cutOff = $_POST['cutOff'];

            if($cutOff == "weekly"){    
                echo "pogi Ako";

                ?>

                <div class="mb-5">
                <label for="dataFrom">Date-From</label>
                <input type="date" name="dateFrom" id="dateFrom">
                <label for="dataTo">Date-To</label>
                <input type="date" name="dateTo" id="dateTo">
                </div>

                <div class="btn-group btn-group-toggle btn-group-vertical" data-toggle="buttons">
                    <label class="btn btn-primary">
                        <input type="checkbox" autocomplete="off">
                        Sunday
                    </label>

                    <label class="btn btn-primary">
                        <input type="checkbox" autocomplete="off" >
                        Monday
                    </label>

                    <label class="btn btn-primary">
                        <input type="checkbox" autocomplete="off">
                        Tuesday
                    </label>
                    <label class="btn btn-primary">
                        <input type="checkbox" autocomplete="off">
                        Wednesday
                    </label>

                    <label class="btn btn-primary">
                        <input type="checkbox" autocomplete="off" >
                        Thursday
                    </label>

                    <label class="btn btn-primary">
                        <input type="checkbox" autocomplete="off">
                        Friday
                    </label>

                    <label class="btn btn-primary">
                        <input type="checkbox" autocomplete="off">
                        Saturday
                    </label>
                </div>

                <div class="mb-5" >
                <!-- ../php/CP_schedule.php -->
                    <form action="" method="post">
                    <button type="submit" class="btn btn-info btn-sm mt-2" name="all" id="all">all</button>
                    <small>if Time in&out is Same (click all) </small>
                        <div class="mb-5">
                        <label>Time-in</label>
                        <input type="time" name="timeIn" id="timeIn"><br>
                        <label>Time-Out</label>
                        <input type="time" name="timeOut" id="timeOut">
                        </div> 

                        <?php
                            if(isset($_POST['all'])){
                                $timeIn = $_POST['timeIn'];
                                $timeOut = $_POST['timeOut'];
                        
                                echo "Your time in is: ".$timeIn; 
                                echo "Your time Out is: ".$timeOut; 
                        
                        
                             }
                        ?>

                        <div class="mb-5">
                        <label for="timeIn2">Time-in</label>
                        <input type="time" name="timeIn2" id="timeIn2" value="<?echo $timeIn;?>"><br>
                        <label for="timeOut2">Time-Out</label>
                        <input type="time" name="timeOut2" id="timeOut2" value="<?echo $timeOut;?>">
                        </div>

                        <div class="mb-5">
                        <label for="timeIn3">Time-in</label>
                        <input type="time" name="timeIn3" id="timeIn3"><br>
                        <label for="timeOut3">Time-Out</label>
                        <input type="time" name="timeOut3" id="timeOut3">
                        </div>

                        <div class="mb-5">
                        <label for="timeIn4">Time-in</label>
                        <input type="time" name="timeIn4" id="timeIn4"><br>
                        <label for="timeOut4">Time-Out</label>
                        <input type="time" name="timeOut4" id="timeOut4">
                        </div>

                        <div class="mb-5">
                        <label for="timeIn5">Time-in</label>
                        <input type="time" name="timeIn5" id="timeIn5"><br>
                        <label for="timeOut5">Time-Out</label>
                        <input type="time" name="timeOut5" id="timeOut5">
                        </div>

                        <div class="mb-5">
                        <label for="timeIn6">Time-in</label>
                        <input type="time" name="timeIn6" id="timeIn6"><br>
                        <label for="timeOut6">Time-Out</label>
                        <input type="time" name="timeOut6" id="timeOut6">
                        </div>

                    </form>

                </div>

                <?php

            }elseif($cutOff == "Half-A-Month"){
                echo "Napaka Pogi Ko";

                ?>
                
                <div class="mb-5">
                <label for="dataFrom">Date-From</label>
                <input type="date" name="dateFrom" id="dateFrom">
                <label for="dataTo">Date-To</label>
                <input type="date" name="dateTo" id="dateTo">
                </div>

                <?php
            }
        }
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

            <?php //} ?>

</body>
</html>



