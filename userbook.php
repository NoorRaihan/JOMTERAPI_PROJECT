<?php 

    include'authorized.php';
    $conn = new mysqli("localhost", "root", "", "mbsadmin");
    
    if ($conn -> connect_error) {
        echo "FAILED!";
        exit(-1);
        $conn -> close();
    }

    $sql = "SELECT * FROM users WHERE id = 1";

    $query = $conn -> query($sql);


    while ($row = $query->fetch_assoc()) {
        $name = $row['username'];
    }


?>


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <link rel="stylesheet" href="user.css">
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
        <?php  include'userhead.php' ?>
        <section class="user-cont">
            <div class="user-inner">
                <h1>BOOKING SYSTEM</h1>
                <div class="nama">
                    <p style="font-weight: bold;">NAME</p>
                    <p style="margin-top: 1px; "><?php echo $name ?></p>
                </div>
            <form>
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
               <b><label for="date">DATE</label></b><br>
                <input type="date" name="date" id="date" placeholder="dd/mm/yyyy">
                <br>
                <br>
                <p style="width:280px; margin:auto; padding-bottom: 30px;;">Any problem or custom booking, please call 013-737-2091</p>

                <input type="submit" value="BOOK NOW">
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