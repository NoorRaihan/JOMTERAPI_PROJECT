<?php
    require_once('./script/config.php');
    include'include/authorized.php';

    $conn = db();
    $from = $_POST['t-from']?? NULL;
    $to = $_POST['t-to']?? NULL;
    $delay = intval($_POST['delay']?? NULL);
    $sql = "UPDATE default_slot SET time_from = '$from', time_to = '$to'";
    
    function generateTime($from,$to,$delay) {
        $conn = db();
        $temp_from = $from;
        $temp_to = $to;
        $stamp_from = strtotime($temp_from);
        $stamp_to = strtotime($temp_to);

        if($stamp_to <= $stamp_from && $stamp_to >= 1620345600) {
            $stamp_to = $stamp_to + (60*60*24);

        } else if($stamp_to <= $stamp_from) {
            echo "<script>alert('FROM time cant be bigger than TO time!'); window.location.href = 'setting.php'</script>";
        }

        while($stamp_from < $stamp_to) {
            $time = date('H:i', $stamp_from);
            $sql_time = "INSERT INTO slots(time) VALUES('$time')";
            $slotq = $conn->query($sql_time);
            $stamp_from = $stamp_from + 60*$delay;
        }
    }

    if($from != NULL) {
        $query = $conn->query($sql);
        if($query) {
            
            $check_row = "SELECT COUNT(TIME) AS COUNTER FROM slots";
            $q_row = $conn->query($check_row) or die();
            $fetch_row = $q_row->fetch_assoc();
            
            if($fetch_row['COUNTER'] != 0) {
                $clear_row = "DELETE FROM slots";
                $clear = $conn->query($clear_row) or die();
                generateTime($from,$to,$delay);
            } else {
                generateTime($from,$to,$delay);
            }

        } else {
            echo "<script>alert('Opps! something went wrong'); window.location.href = 'setting.php'</script>";
        }
    } else {
        $from = NULL;
        $to = NULL;
    }

    
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/dash.css">
        <link rel="stylesheet" href="css/client.css">
    </head>
    <body>
    <?php include'include/adminhead.php'?>
       <section style="padding-left: 25%; padding-top:50px;" class="time">
            <form action="setting.php" method="POST">
                <h3>WORKING HOUR</h3>
                <strong><label for="t-from">FROM</label></strong>
                <input type="time" class="t-from" id="t-from" name="t-from" min="00:00" required/>

                <strong><label for="t-to">TO</label></strong>
                <input type="time" class="t-to" id="t-to" name="t-to" min="00:00" max="23:59" required/><br><br>

                <strong><label for="delay">PER SLOT</label></strong>
                <input type="number" class="delay" id="delay" name="delay" required/>
                <strong><label for="delay">minutes</label></strong><br><br>
                <input type="submit" class="btn" value="submit"/>
            </form>

       </section>
        
        <script src="" async defer></script>
    </body>
</html>