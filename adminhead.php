<?php
    include'validaterole.php';
    $username = strtoupper($_SESSION['username']);
?>


<header>
            <section class="navbar">
                <i id="home" class="fas home fa-home"></i>
                <a href="logout.php"><i onClick="" id="logout__" class="fas fa-sign-out-alt"></i></a>
                <div class="navbar-2">
                    <p>MBS<span style="font-size: 20px;">ADMIN</span></p>

                </div>
            </section>

            <section class="sidebar">
                <div class="sidebar-inner row justify-content-around">
                    <div class="username-pic col-md-3">
                        <img src="images/pp.jpg" class="pp rounded-circle">
                    </div>
                    <div class="username-name col">
                        <div class="">
                            <h7>WELCOME</h7><br>
                            <?php
                            if($desc_role == 1) { ?>
                            <b><h7><?php echo $username,"(ADMIN)"; ?></h7></b>
                            <?php
                            } else { ?>
                                <b><h7><?php echo $username; ?></h7></b> <?php
                            } ?>
                        </div>
                    </div>
                    <div class="listing">
                        <ul class="list-inner">

                        <?php
                            if($desc_role == 1) { ?>
                                <li><a href="dashboard.php">Dashboard</a></li>
                                <li><a href="client.php">Clients</a></li>
                                <li><a href="calendar.php">Calendar</a></li>
                                <li><a href="regisclient.php">Registered Clients</a></li>
                                <li><a href="history.php">Booking History</a></li>
                                <li><a href="history2.php?status=canceled">Canceled Booking</a></li>
                                <li><a href="history2.php?status=done">Approved Booking</a></li>
                                <li><a href="usersettings.php">Account</a></li> 

                                
                            <?php
                            } else { ?>

                                <li><a href="dashboard.php">Dashboard</a></li>
                                <li><a href="booking.php">All Bookings</a></li>
                                <li><a href="booking.php?status=active">Active Bookings</a></li>
                                <li><a href="booking.php?status=expired">Expired Bookings</a></li>
                                <li><a href="userbook.php">Create Booking</a></li>
                                <li><a href="history.php">Booking History</a></li>
                                <li><a href="history2.php?status=canceled">Canceled Booking</a></li>
                                <li><a href="history2.php?status=done">Approved Booking</a></li>
                                <li><a href="usersettings.php">Account</a></li>

                            <?php
                            }
                        
                        ?>
                            
                        </ul>
                    </div>
                    
                    
                </div>
            </section>
        </header>

        <script>
    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

   
