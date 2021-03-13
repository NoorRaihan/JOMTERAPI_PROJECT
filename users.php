<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="user.css">
        <link rel="stylesheet" href="dash.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>USER DASHBOARD</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <?php include'userhead.php'; ?>

        <section class="menu">
        <div class="menu-inner row row-cols-md-3">
            <div class="col">
                <div id="clients_" class="card text-white mb-3" style="max-width: 18rem;">
                    <div class="card-body card-counter primary">
                        <span class="count-numbers"><b>BOOKING</b></span>
                        <span class="count-name">Create Booking</span>
                        <i class="fas fa-user"></i>
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
            <div class="col">
                <div id="admin_" class="card text-white mb-3" style="max-width: 18rem;">
                    <div class="card-body card-counter success">
                        <span class="count-numbers"><b>BOOKED</b></span>
                        <span class="count-name">Booking History</span>
                        <i class="fas fa-user-shield"></i>
                    </div>
                </div>
            </div>
            <div class="col">
                <div id="logout_" class="card text-white mb-3" style="max-width: 18rem;">
                    <div class="card-body card-counter success">
                        <span class="count-numbers"><b>LOGOUT</b></span>
                        <span class="count-name"></span>
                        <i class="fas fa-sign-out-alt"></i>
                    </div>
                </div>
            </div>
        </div>   
    </section>
        

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <script src="" async defer></script>
    </body>
</html>