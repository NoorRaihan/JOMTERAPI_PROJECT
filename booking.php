<?php 
    require_once('config.php');
    include'authorized.php';
    setlocale(LC_ALL, 'ms_MY');

    $conn = db();
    $date = strftime("%e %B %Y %R %p");
    $username = $_SESSION['username'];
    $check_id = "SELECT members.id FROM members INNER JOIN users ON members.u_id = users.id WHERE users.username = '$username'";
    
    $GET_ID = $conn->query($check_id);
    $ID_u = $GET_ID->fetch_assoc();

    $sql = "SELECT members.phone, orders.id, orders.dates, IF(orders.dates<NOW() ,'expired' ,STATUS) AS STATUS, orders.customers, orders.person, orders.type, orders.message, orders.status 
    FROM orders
    INNER JOIN members ON orders.members_id = members.id
    WHERE members.id =".$ID_u['id']." AND orders.status <> 'canceled'";
    
    $GET_ORDERS = $conn->query($sql);
    
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
        <title>Client</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" href="client.css">
        <link rel="stylesheet" href="dash.css">
    </head>
    <body>
    <?php include'adminhead.php';
        $u_id = $ID_u['id'];
        $latest_date = "SELECT DATEDIFF((SELECT dates FROM orders WHERE id = (SELECT MAX(id) FROM orders) AND members_id = $u_id AND status = 'active'), NOW()) AS duration";

        
        $get_date = $conn->query($latest_date);

        $get_dur = $get_date->fetch_assoc();

        if($get_dur['duration'] == 0) {
            
            $duration = "TODAY";
        } else {
            $duration = $get_dur['duration']." days";
        }
    ?>
    <section class="menu">
        <div class="menu-inner row row-cols-md-4">
            <div class="col">
                <div class="card text-white mb-3" style="max-width: 18rem;">
                    <div class="card-body card-counter info">
                        <span class="count-numbers"><b><?php echo $duration; ?></b></span>
                        <span class="count-name">Your Booking</span>
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>
            <div class="col">
                <ul class="listings">
                    <b><li class="listlist">S    - SARAF</li></b>
                    <b><li class="listlist">B    - BEKAM</li></b>
                    <b><li class="listlist">TS   - SPORT THERAPY</li></b>
                    <b><li class="listlist">TB   - TULANG BELAKANG</li></b>
                    <b><li class="listlist">T    - TERSELIUH</li></b>
                    <b><li class="listlist">O    - OTHER</li></b>
                </ul>
            </div>
        </div>    
    </section>
    
    

    <section class="table_client">
        <table class="table-inner table table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">DATE AND TIME</th>
                <th scope="col">NAME</th>
                <th scope="col">P</th>
                <th scope="col">PHONE NUMBER</th>
                <th scope="col">TYPE</th>
                <th scope="col">MESSAGE</th>
                <th scope="col">STATUS</th>
                <th scope="col">//</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $i = 0;
                $check_row = $GET_ORDERS->num_rows;
                

                if($check_row == 0) {
                    echo "<tr><td colspan='9'>0 booking</td></tr>";
                } else {
                    while($row = $GET_ORDERS->fetch_assoc()) {
                        
                        
                        switch ($row['STATUS']) {
                            case 'expired' :
                                $row['STATUS'] = "<a id='toggle' data-toggle='modal'  style='color:red;' 
                                data-id='".$row['id']."' href='#myModal'>expired</a>";
                        }

                        echo "<tr><th scope='row'>".($i+1)."</th>
                        <td>".$row['dates']."</td>
                        <td>".$row['customers']."</td>
                        <td>".$row['person']."</td>
                        <td>".$row['phone']."</td>
                        <td>".$row['type']."</td>
                        <td>".$row['message']."</td>
                        <td><span style='color: forestgreen; font-weight:bold;'>".$row['STATUS']."</span></td>
                        <td><form action='book_status.php' method='POST'><button type='submit' name='cancel' id='cancel' value='".$row['id']."'>CANCEL</button></form></td></tr>";
                        $i++;
                    }
                }
              
              
              ?>
            </tbody>
          </table>
    </section>

    <!-- MODAL STUFFS## TEST PURPOSE-->
    <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Your Booking has been Expired!</h4>
            </div>
            <div class="modal-body">
                <p>Do you wish to cancel or reschedule the booking?</p>
                <form action="book_status.php" method="POST">
                    <div class="fetched-data"></div>
                    <label>Set new date for your booking</label><br>
                    
                    <input type="datetime-local" name="reschedule-date" id="reschedule"><br>
                    <button type="submit" name="reschedule" id="reschedule" class="btn btn-default" value="<?php $dataid ?>">Reschedule</button>
                    <button type="submit" name="cancel" class="btn btn-default"  value="<?php $dataid ?>">Cancel</button>
            
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>

    </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <script>

        $( "#home" ).click(function() {
            window.open('dashboard.php', "_self"); 
        });
        
        // $( "#toggle" ).click(function() {
        //     $('#dataid').text($(this).data('id')); 
        //     $('#showmodal').modal('show');
        // });

        $(document).ready(function(){
            $('#myModal').on('show.bs.modal', function (e) {
                var rowid = $(e.relatedTarget).data('id');
                $.ajax({
                    type : 'post',
                    url : 'booking.php', //Here you will fetch records 
                    data :  'id='+ rowid, //Pass $id
                    success : function(data){
                    $('.fetched-data').html(data);//Show fetched data from database
                    }
                });
            });
        });
    </script>
    </body>
</html>
