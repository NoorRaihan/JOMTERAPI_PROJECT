<?php
    require_once('config.php'); 
    include'authorized.php';
    $date = date("d M");
   //still trying to get it into fucntional

    function counting() {
        $conn = db();
        $sql = "SELECT members.firstname, members.lastname, members.sex, members.phone, members.u_id,users.username, users.email 
        FROM members 
        INNER JOIN users ON members.u_id = users.id 
        WHERE users.roles <> 1";
        
        $count = $conn->query($sql);
        return $count->num_rows;
    }

    function countBook() {
        $conn = db();
        $booking = "SELECT * FROM orders WHERE status = 'active' AND dates = NOW()";

        $GET_BOOK = $conn->query($booking);
        return $GET_BOOK->num_rows;
    }
    
    function checkBook() {
        $conn = db();
        $username = $_SESSION['username'];
        $check_id = "SELECT members.id FROM members INNER JOIN users ON members.u_id = users.id WHERE users.username = '$username'";
        $GET_ID = $conn->query($check_id);
        $ID_u = $GET_ID->fetch_assoc();
        
        $u_id = $ID_u['id'];
        $latest_date = "SELECT DATEDIFF((SELECT dates FROM orders WHERE id = (SELECT MAX(id) FROM orders WHERE status = 'active' AND dates >= NOW()) AND members_id = $u_id AND status = 'active'), NOW()) AS duration";
        $get_date = $conn->query($latest_date);

        $get_dur = $get_date->fetch_assoc();
        
        if($get_dur['duration'] == 0 && $get_dur['duration'] != NULL) {
            $duration = "TODAY";
        } else if($get_dur['duration'] < 0 || $get_dur['duration'] == NULL) {
            $duration = "0 BOOKING";
        } else {
            $duration = $get_dur['duration']." days";
        }
        
        return $duration;
    
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
        <title>DASHBOARD</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" href="dash.css">
    </head>
    <body>
       <?php 
            include'adminhead.php';
            include'validaterole.php';

            if($desc_role == 1) { ?>

<section class="menu">
        <div class="menu-inner row row-cols-md-3">
            <div class="col">
                <div id="clients_" class="card text-white mb-3" style="max-width: 18rem;">
                    <div class="card-body card-counter primary">
                        <span class="count-numbers"><b><?php echo countBook();?></b><span style="font-size: 20px;">  bookings</span></span>
                        <span class="count-name">Clients Today</span>
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>
            <div class="col">
                <div id="calendar_" class="card text-white mb-3" style="max-width: 18rem;">
                    <div class="card-body card-counter primary">
                        <span class="count-numbers"><b><?php echo $date; ?></b></span>
                        <span class="count-name">Calendar</span>
                        <i class="far fa-calendar-alt"></i>
                    </div>
                </div>
            </div>
            <div class="col">
                <div id="regisclient_" class="card text-white mb-3" style="max-width: 18rem;">
                    <div class="card-body card-counter primary">
                        <span class="count-numbers"><b><?php echo counting(); ?></b><span style="font-size: 20px;"> people</span></span>
                        <span class="count-name">Registered Client</span>
                        <i class="fas fa-user-friends"></i>
                    </div>
                </div>
            </div>
            <div class="col">
                <div id="history_" class="card text-white mb-3" style="max-width: 18rem;">
                    <div class="card-body card-counter primary">
                        <span class="count-numbers"><b>BOOKED</b></span>
                        <span class="count-name">Booking History</span>
                        <i class="fas fa-history"></i>
                    </div>
                </div>
            </div>
            <div class="col">
                <div id="admin_" class="card text-white mb-3" style="max-width: 18rem;">
                    <div class="card-body card-counter success">
                        <span class="count-numbers"><b>USER</b></span>
                        <span class="count-name">Account</span>
                        <i class="fas fa-user-shield"></i>
                    </div>
                </div>
            </div>
            
        </div>   
    </section><?php

            } else { ?>

                <section class="menu">
        <div class="menu-inner row row-cols-md-3">
            <div class="col">
                <div id="booking_" class="card text-white mb-3" style="max-width: 18rem;">
                    <div class="card-body card-counter info">
                        <span class="count-numbers"><b><?php echo checkBook(); ?></b></span>
                        <span class="count-name">Booking Reminder</span>
                        <i class="fas fa-bookmark"></i>
                    </div>
                </div>
            </div>
            <div class="col">
                <div id="c_book_" class="card text-white mb-3" style="max-width: 18rem;">
                    <div class="card-body card-counter primary">
                        <span class="count-numbers"><b>BOOKING</b></span>
                        <span class="count-name">Create Booking</span>
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>
            <div class="col">
                <div id="history_" class="card text-white mb-3" style="max-width: 18rem;">
                    <div class="card-body card-counter primary">
                        <span class="count-numbers"><b>BOOKED</b></span>
                        <span class="count-name">Booking History</span>
                        <i class="fas fa-history"></i>
                    </div>
                </div>
            </div>
            <div class="col">
                <div id="admin_" class="card text-white mb-3" style="max-width: 18rem;">
                    <div class="card-body card-counter success">
                        <span class="count-numbers"><b>USER</b></span>
                        <span class="count-name">Account</span>
                        <i class="fas fa-user-shield"></i>
                    </div>
                </div>
            </div>
            
        </div>   
    </section> <?php

            }

    ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <script>

        $( "#clients_" ).click(function() {
            window.open('client.php', "_self"); 
        });

        $( "#history_" ).click(function() {
            window.open('history.php', "_self"); 
        });

        $( "#booking_" ).click(function() {
            window.open('booking.php', "_self"); 
        });


        $( "#calendar_" ).click(function() {
            window.open('calendar.php', "_self"); 
        });

        $( "#admin_" ).click(function() {
            window.open('usersettings.php', "_self"); 
        });

        $( "#regisclient_" ).click(function() {
            window.open('regisclient.php', "_self"); 
        });

        // $( "#logout_" ).click(function() {
        //     window.open('logout.php', "_self"); 
        // });

        $( "#c_book_" ).click(function() {
            window.open('userbook.php', "_self"); 
        });
        
       
    </script>

    </body>
</html>