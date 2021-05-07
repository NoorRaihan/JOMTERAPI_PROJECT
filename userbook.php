<?php 
    require_once('./script/config.php');
    include'include/authorized.php';
    
    $alert = 'none';
    if(isset($_POST['submit'])) {
        $alert = booking();
    }

    function viewName() {
        $conn = db();
        $username = $_SESSION['username'];
        $sql = "SELECT members.firstname, members.lastname FROM members INNER JOIN users ON users.id = members.u_id
        WHERE users.username = '$username'";

        $GET_NAME = $conn->query($sql);
        $res = $GET_NAME->fetch_assoc();
        return strtoupper($res['firstname'].' '.$res['lastname']);
    }

    function booking() {
        $conn = db();
        $type_r = $conn->real_escape_string($_POST['typer']);
        $date_ = new DateTime($_POST['date']);
        $time_ = new DateTime($_POST['slot']);
        $date_->setTime($time_->format('H'), $time_->format('i'), $time_->format('s'));
        $date_ = $date_->format('Y-m-d H:i:s');
        $person_ = $conn->real_escape_string($_POST['person']);
        $message_ = $conn->real_escape_string($_POST['message']);
        $cust_name = viewName();
        $username = $_SESSION['username'];
        $SQL_MEM_ID = "SELECT members.id FROM members INNER JOIN users ON members.u_id = users.id WHERE users.username = '$username'";
        
        $MEM_ID_RES = $conn->query($SQL_MEM_ID);
        $MEM_ID_FETCH = $MEM_ID_RES->fetch_assoc();
        $MEM_ID = $MEM_ID_FETCH['id'];

        //------------filter bruh---------------------//
        $fil = "SELECT COUNT(date_time) AS CC FROM unavailable WHERE date_time = '$date_'"; //filter the unavailbale
        $qfil = $conn->query($fil);
        $f_fil = $qfil->fetch_assoc();

        $fil2 = "SELECT COUNT(dates) AS CC2 FROM orders WHERE dates = '$date_'"; //filter slot has been taken or not
        $qfil2 = $conn->query($fil2);
        $f_fil2 = $qfil2->fetch_assoc();


        if($f_fil['CC'] > 0 || $f_fil2['CC2'] > 0) {
            
            $alert = "block";
            return $alert;

        } else {

            $sql = "INSERT INTO orders(username,dates,customers,person,type,message,members_id) VALUES('$username','$date_','$cust_name',$person_,'$type_r','$message_',$MEM_ID)";
            $BOOK = $conn->query($sql);
            
            if($BOOK) {
                echo "<script>alert('Your booking successfully created!'); window.location.href='booking.php';</script>";
            }else {
                echo "<script>alert('Booking can't be created!')</script>";
            }
            
        }
        //-------------------------------------------//
       
        
    }


    
?>


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <link rel="stylesheet" href="css/user.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>USER BOOKING</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <?php  include'./include/userhead.php' ?>
        <section class="user-cont">
            <div class="user-inner">
                <h1>BOOKING SYSTEM</h1>
                <div class="nama">
                    <p style="font-weight: bold;">NAME</p>
                    <p style="margin-top: 1px; "><?php echo viewName(); ?></p>
                </div>
            <form action="userbook.php" method="POST">
                <div class="wrap-in">
                    <div class="person">
                        <b><label for="person">PERSON</label></b><br>
                        <input type="number" name="person" id="person" placeholder="No">
                    </div>

                    <div class="type-r">
                        <b><label for="typer">TYPE</label></b><br>
                        <select id="typer" name="typer">
                            <option value="S">SARAF</option>
                            <option value="B">BEKAM</option>
                            <option value="TS">SPORT THERAPY</option>
                            <option value="TB">TULANG BELAKANG</option>
                            <option value="T">TERSELIUH</option>
                            <option value="O">OTHER</option>
                        </select>
                        </div>
                </div>
                <div class="row">
                    <div class="col">
                    <b><label for="date">DATE</label></b><br>
                        <input type="date" name="date" id="date" placeholder="dd/mm/yyyy">
                    </div>
                    <div class="col">
                        <b><label for="slot">SLOT</label></b><br>
                        <select name="slot" id="slot">
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
                        <?php
                        
                            echo " <div style='display:$alert;' class='alert' id='alert'><p style='color:red;'>Slots are not available!</p></div>";
                        
                        ?>
                       
                    </div>
                    </div>                
                <br>
                <b><label for="message">MESSAGES</label></b><br>
                <input type="text" name="message" id="message" placeholder="your messages">
                <br>
                <br>
                <p style="width:280px; margin:auto; padding-bottom: 30px;;">Any problem or custom booking, please call 013-737-2091</p>

                <input type="submit" name="submit" value="BOOK NOW">
            </form>
            </div>
        </section>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

        <script>

            $( "#back" ).click(function() {
                window.open('dashboard.php', "_self"); 
            });

            $( "#logout" ).click(function() {
                window.open('index.html', "_self"); 
            });
            
           
        </script>
    </body>
</html>