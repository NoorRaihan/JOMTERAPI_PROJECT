<?php
  require_once('./script/config.php');
  include'include/authorized.php';

  $conn = db();
  $date_ = new DateTime($_POST['un-date']?? NULL);
  $slot_ = new DateTime($_POST['un-slot']?? NULL);
  $date_->setTime($slot_->format('H'), $slot_->format('i'), $slot_->format('s'));
  $date = $date_->format("Y-m-d H:i:s");
  $desc = $conn->real_escape_string($_POST['reason']?? NULL);
  
  if(isset($_POST['submit'])) {
    addUnavailable($date,$desc);
  
  } elseif(isset($_POST['delete-un'])){
    deleteUnavailable($_POST['delete-un']);
    echo "test";
  } else {
    $date_ = NULL;
    $slot_ = NULL;
    $desc = NULL;
  }

  function addUnavailable($date,$desc) {
    $conn = db();
    $sql = "INSERT INTO unavailable(date_time,descs) VALUES('$date','$desc')";
    $query = $conn->query($sql);
  }

  function deleteUnavailable($id) {
    $conn=db();
    $sql = "DELETE FROM unavailable WHERE id = $id";
    $query = $conn->query($sql);
  }
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
       <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Calendar</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" href="css/client.css">
        <link rel="stylesheet" href="css/dash.css">
    </head>
    <body>
      <?php include'include/adminhead.php' ?>


        <section  class="lefty">
          <div class="lefty-inner">
            <div class="col-sm-2">
              <h5>UNAVAILABLE DAY</h5>
              <form action="slot.php" method="POST">
              <div class="row">
                <div class="col">
                    <strong><label for="un-date">DATE</label></strong>
                    <input type="date" name="un-date" id="un-date">
                </div>
                <div class="col">
                    <strong><label for="un-slot">SLOTS</label></strong><br>
                    <select id="un-slot" name="un-slot">
                      <?php
                          $conn = db();
                          $slot = "SELECT time FROM slots";
                          $res_slot = $conn->query($slot);

                          while($row = $res_slot->fetch_assoc()) {
                            $time = date("g:i A", strtotime($row['time']));
                            echo "<option value='".$row['time']."'>".$time."</option>";
                          }
                        ?>
                </select>
                </div>
              </div>
                <b><h7>REASON</h7></b>
                <input type="text" name="reason" id="reason"><br>
                <br>
                <input type="submit" class="btn" name="submit" value="Add Date">
              </form>
            </div>
            <div class="col">
              <table class="table-inner table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">DATE</th>
                    <th scope="col">REASON</th>
                    <th scope="col">ACTION</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $get_un = "SELECT * FROM unavailable";
                    $query_un = $conn->query($get_un);
                    $un_row = $query_un->num_rows;
                    
                    $i = 0;
                    if($un_row == 0) {
                      echo "<tr><td colspan='4'>0 set</td></tr>";
                    } else {
                      while($row2 = $query_un->fetch_assoc()){

                        $time = date("Y-m-d g:i A", strtotime($row2['date_time']));
                        
                        echo "<tr><th scope='row'>".($i+1)."</th>
                        <td>".$time."</td>
                        <td>".$row2['descs']."</td>
                        <td><form action='slot.php' method='POST'><button type='submit' name='delete-un' id='delete-un' value='".$row2['id']."'>DELETE</button></form></td></tr>";
                        $i++;
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </section>

    
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

        <script>

            $( "#home" ).click(function() {
                window.open('dashboard.php', "_self"); 
            });
            
        </script>
    </body>
</html>