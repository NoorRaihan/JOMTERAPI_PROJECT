<?php 
    require_once('config.php');
    include'authorized.php';
    include'validaterole.php';
    setlocale(LC_ALL, 'ms_MY');

    $conn = db();
    $username = $_SESSION['username'];

    $status = $_GET['status'] ?? '';

    if($status == "canceled" || $status == "done") {
        $status = $status;
    } elseif(empty($status)) {
        $status = "canceled";
    } else {
        die("Invalid parameter!");
    }

   
    if($desc_role == 1) {
        $check_id = "SELECT members.id FROM members INNER JOIN users ON members.u_id = users.id WHERE users.username = '$username'";
    

        $GET_ID = $conn->query($check_id);
        $ID_u = $GET_ID->fetch_assoc();

        $sql = "SELECT members.phone, orders.id, orders.dates, orders.customers, orders.person, orders.type, orders.message, orders.status 
        FROM orders 
        INNER JOIN members ON orders.members_id = members.id
        WHERE orders.status = '$status'";

        $GET_ORDER = $conn->query($sql);
    } else {

        $check_id = "SELECT members.id FROM members INNER JOIN users ON members.u_id = users.id WHERE users.username = '$username'";
    

        $GET_ID = $conn->query($check_id);
        $ID_u = $GET_ID->fetch_assoc();
    
        $sql = "SELECT members.phone, orders.id, orders.dates, orders.customers, orders.person, orders.type, orders.message, orders.status 
        FROM orders 
        INNER JOIN members ON orders.members_id = members.id
        WHERE members.id =".$ID_u['id']." AND orders.status = '$status'";
    
        $GET_ORDER = $conn->query($sql);
    }
    
    $COUNT = $GET_ORDER->num_rows;
    
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
    <?php include'adminhead.php' ?>
    <section class="menu">
        <div class="menu-inner row row-cols-md-4">
            <div class="col">
                <div class="card text-white mb-3" style="max-width: 18rem;">
                    <div class="card-body card-counter primary">
                        <span class="count-numbers"><b><?php echo $COUNT;?></b><span style="font-size: 20px;">  bookings</span></span>
                        <span class="count-name">Booking history</span>
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>
            <div class="col">
                <ul class="listings">
                <?php 
                   
                ?>
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
                
                <th scope="col">P</th>
                <th scope="col">PHONE NUMBER</th>
                <th scope="col">TYPE</th>
                <th scope="col">MESSAGE</th>
                <th scope="col">STATUS</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $i = 0; 

                while($row = $GET_ORDER->fetch_assoc()) {
                  echo "<tr><th scope='row'>".($i+1)."</th>
                  <td>".$row['dates']."</td>
                  <td>".$row['person']."</td>
                  <td>".$row['phone']."</td>
                  <td>".$row['type']."</td>
                  <td>".$row['message']."</td>
                  <td>".$row['status']."</td></tr>";
                  $i++;
                }
              
              
              ?>
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
        
       
    </script>
    </body>
</html>
