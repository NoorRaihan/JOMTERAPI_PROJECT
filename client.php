<?php 

    include'authorized.php';
    setlocale(LC_ALL, 'ms_MY');

    $date = strftime("%e %B %Y %R %p");
    $data = array(
        array($date, "MUHAMAD SAJAT" , 2, "01253643846", 'T', "Berikan saya urutan mantap"),
        array($date, "HAIKAL HAKIMI" , 1, "0153647865", 'O', "Kaki saya kena buatan orang"),
        array($date, "MUHAMAD DANISH" , 1, "0133244876", 'S', "tangan saya tk boleh gerak"),
        array($date, "NUR AIN" , 3, "01936458899", 'TB', "Tualng belakang saya bengkok"),
        array($date, "RAMESH RAMJAN" , 1, "0113638896", 'TS', "buku lali saya sakit main bola"),
        array($date, "AHMAD ABU" , 2, "0123623623", 'B', "N/A"),
        array($date, "ZARITH SOFIA" , 1, "0145668875", 'TS', "Kaki saya bengkak main hoki"),
    );


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
                        <span class="count-numbers"><b>03</b><span style="font-size: 20px;">  people</span></span>
                        <span class="count-name">Clients Today</span>
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
                <th scope="col">//</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                for ($i=0; $i < 7; $i++) {
                  echo "<tr><th scope='row'>".($i+1)."</th><td>".$data[$i][0]."</td><td>".$data[$i][1]."</td><td>".$data[$i][2]."</td><td>".$data[$i][3]."</td><td>".$data[$i][4]."</td><td>".$data[$i][5]."</td><td><span style='color:red;'  >CANCEL</span></td></tr>";
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
