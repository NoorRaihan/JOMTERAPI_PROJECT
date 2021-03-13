<?php 
  include'authorized.php';
  $data = array(
    array("MUHAMAD", "SAJAT", 'M', "0128829846", "MUHD_001", "sajat001@gmail.com"),
    array("HAIKAL", "HAKIMI", 'M', "0128829846", "Kimi56", "hkimi23@gmail.com"),
    array("MUHAMAD", "DANISH", 'M', "0128829846", "Danish8", "danish99@gmail.com"),
    array("NUR", "AIN", 'F', "0128829846", "ainA0", "ainnur1@gmail.com"),
    array("RAMESH", "RAMJAN", 'M', "0128829846", "rameshJ2", "rameshrmjn2@gmail.com"),
    array("AHMAD", "ABU", 'M', "0128829846", "aBU98", "abuahmad@gmail.com")
  );



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
        <link rel="stylesheet" href="client.css">
        <link rel="stylesheet" href="dash.css">
    </head>
    <body>
      <?php include'adminhead.php';?>

    <section class="menu">
        <div class="menu-inner row row-cols-md-4">
            <div class="col">
                <div class="card text-white mb-3" style="max-width: 18rem;">
                    <div class="card-body card-counter primary">
                        <span class="count-numbers"><b>5</b><span style="font-size: 20px;">  people</span></span>
                        <span class="count-name">Registered Client</span>
                        <i class="fas fa-user-friends"></i>
                    </div>
                </div>
            </div>
        </div>    
    </section>

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
                <th scope="col">PASSWORD</th>
                <th scope="col">EMAIL</th>
                <th scope="col">//</th>
              </tr>
            </thead>
            <tbody>
              <tr>
              <?php 
                for ($i=0; $i < 5; $i++) {
                  echo "<tr><th scope='row'>".($i+1)."</th><td>".$data[$i][0]."</td><td>".$data[$i][1]."</td><td>".$data[$i][2]."</td><td>".$data[$i][3]."</td><td>".$data[$i][4]."</td><td>*********</td><td>".$data[$i][5]."</td><td><span style='color:red;'  >DELETE</span></td></tr>";
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
        
    </script>
    </body>
</html>