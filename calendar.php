<?php
  require_once('config.php');
  include'authorized.php';

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
        <link rel="stylesheet" href="client.css">
        <link rel="stylesheet" href="dash.css">
    </head>
    <body>
      <?php include'adminhead.php' ?>


        <section  class="lefty">
          <div class="lefty-inner">
            <div class="col-sm-2">
              <h5>UNAVAILABLE DAY</h5>
              <form>
                <input type="datetime-local" name="un-date" id="un-date"><br>
                <b><h7>REASON</h7></b>
                <input type="text" name="reason" id="reason"><br>
                <br>
                <input type="submit" class="btn" value="Add Date">
              </form>
            </div>
            <div class="col">
              <table class="table-inner table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">DATE</th>
                    <th scope="col">TIME</th>
                    <th scope="col">REASON</th>
                    <th scope="col">//</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>11 JAN 2021</td>
                    <td>9:00PM</td>
                    <td>CHINESE NEW YEAR</td>
                    <td><span style="color:red;">DELETE</span></td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>11 JAN 2021</td>
                    <td>9:00PM</td>
                    <td>CHINESE NEW YEAR</td>
                    <td><span style="color:red;">DELETE</span></td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>11 JAN 2021</td>
                    <td>9:00PM</td>
                    <td>CHINESE NEW YEAR</td>
                    <td><span style="color:red;">DELETE</span></td>
                  </tr>
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