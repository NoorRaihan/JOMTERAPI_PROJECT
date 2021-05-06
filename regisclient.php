<?php
  include'include/authorized.php';
  require_once('./script/config.php');
  $conn = db();
  $delete = $_POST['delete']??

  
  $sql_user = "SELECT users.roles, members.firstname, members.lastname, members.sex, members.phone, members.u_id,users.username, users.email 
  FROM members 
  INNER JOIN users ON members.u_id = users.id";

  $GET_DATA = $conn->query($sql_user);
  $COUNT_MEM = $GET_DATA->num_rows;
?>


<!DOCTYPE html>
<html>
    <head>
       <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Registered Client</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" href="css/client.css">
        <link rel="stylesheet" href="css/dash.css">
    </head>
    <body>
      
    <?php include'include/adminhead.php'; ?>
    <section class="menu">
        <div class="menu-inner row row-cols-md-4">
            <div class="col">
                <div class="card text-white mb-3" style="max-width: 18rem;">
                    <div class="card-body card-counter primary">
                        <span class="count-numbers"><b><?php echo $COUNT_MEM ?></b><span style="font-size: 20px;">  people</span></span>
                        <span class="count-name">Registered Client</span>
                        <i class="fas fa-user-friends"></i>
                    </div>
                </div>
            </div>
        </div>    
    </section>

    <!-- MODAL STUFFS## TEST PURPOSE-->
    <!-- ################################################################################################### -->
    <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Role Change Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Do you wish to proceed this action?</p>
                <form action="./script/book_status.php" method="POST">
                    <input type='hidden' name='updateid' id='updateid' readonly="readonly"/>
                    <label>Set new date for your booking</label><br>
                    <input type="date" name="reschedule-date" id="reschedule"><br>
                    <select name="reschedule-slot" id="reschedule-slot">
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
                    <button type="submit" class="btn btn-default" name="reschedule" value="reschedule">Reschedule</button>
                   
                    
            
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>

    </div>
    </div>

    <!-- ################################################################################################### -->

    <section class="table_client">
        <table class="table-inner table table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">F NAME</th>
                <th scope="col">L NAME</th>
                <th scope="col">SEX</th>
                <th scope="col">PHONE NUMBER</th>
                <th scope="col">USERNAME</th>
                <th scope="col">EMAIL</th>
                <th scope="col">ROLE</th>
                <th scope="col">ACTION</th>
              </tr>
            </thead>
            <tbody>
              <tr>
              <?php
                $COUNT = 0; 
                
                if($COUNT_MEM == 0){
                  echo "<tr><td colspan='9'>0 result</td></tr>";
                }

                while($row = $GET_DATA->fetch_assoc()) {
                  if($row['roles'] == 1) {
                    $selected = "selected";
                  } else {
                    $selected = " ";
                  }

                  echo "
                  <tr><th scope='row'>".($COUNT+1)."</th>
                  <td>".$row["firstname"]."</td>
                  <td>".$row["lastname"]."</td>
                  <td>".$row["sex"]."</td>
                  <td>".$row["phone"]."</td>
                  <td>".$row["username"]."</td>
                  <td>".$row["email"]."</td>
                  <td>
                  <form action='./script/changerole.php' method='POST'> 
                  <select name='role' id='role'>
                    <option value='0' $selected>USER</option>
                    <option value='1' $selected>ADMIN</option>
                  </select>
                  <button style='font-weight:bold; font-size: 12px; border: none; color:red;' type='submit' name='crole' id='crole' value='".$row['u_id']."' onclick='return confirm(`Are you sure want to proceed this action?`)'>CHANGE</button>
                  </form>
                  </td>
                  <td><form action='./script/delete.php' method='POST'><button type='submit' name='delete' id='delete' value='".$row['u_id']."' onclick='return confirm(`Are you sure want to proceed this action?`)'>DELETE</button></form></td></tr>";
                  $COUNT++;
                }

              ?>
              </tr>
            </tbody>
          </table>
    </section>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <script>

        $( "#home" ).click(function() {
            window.open('dashboard.php', "_self"); 
        });
        
        $( ".toggle" ).on('click', function() {
            $('#myModal').modal('show');

            
            $tr = $(this).closest('tr');
            var data =  $tr.children('td').map(function() {
                return $(this).text();
            }).get();
            console.log(data);
            
            $('#updateid').val(data[0]);
               
        });

    </script>
    </body>
</html>