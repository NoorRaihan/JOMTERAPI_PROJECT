<?php
    include'authorized.php';
    require_once('config.php');
    include'validaterole.php';
    $conn = db();
    if(!isset($_POST['submit'])) {

        $fname = $lname = $gender = $email = $pnumber = $username = "";
    }else {

        $fname = $conn->real_escape_string($_POST['fname']);
        $lname = $conn->real_escape_string($_POST['lname']);
        $gender = $conn->real_escape_string($_POST['gender']);
        $email = $conn->real_escape_string($_POST['email']);
        $pnumber = $conn->real_escape_string($_POST['p-num']);
        $username = $conn->real_escape_string($_POST['username']);
        $password = $conn->real_escape_string($_POST['pass']);

        $options = [
            'memory_cost' => 2048,
            'time_cost' => 4
        ];
        $TIMESTAMP = date('Y-m-d H:i:s');
        $hash = password_hash($password, PASSWORD_ARGON2I,$options);
    
        $UPDATE_USERS_TABLE = "UPDATE IGNORE users SET username = '$username', passwords = '$hash', email = '$email', updated_at = '$TIMESTAMP', updated_by = '$session_user'";
        $UPDATE_MEMBERS_TABLE = "UPDATE members SET firstname = '$fname', lastname = '$lname', sex = $gender, phone = '$pnumber'";
    
        $UPDATE_USERS = $conn->query($UPDATE_USERS_TABLE);
        $UPDATE_MEMBERS = $conn->query($UPDATE_MEMBERS_TABLE);
    
        if($UPDATE_USERS === TRUE && $UPDATE_MEMBERS === TRUE) { ?>
            <script>
                alert("Data successfully updated!")
            </script><?php
        } else { ?>
            <script>
                alert("Data can't be updated!")
            </script><?php
        }
    
    }
?>
    

<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" href="userset.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>USER SETTING</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="dash.css">
    </head>
    <body>
    <?php include'adminhead.php' ?>
        <section class="row prof-pic">
            <div class="col-2 prof-pic-inner">
            <?php
                        $conn = db(); 
                        $getpic = "SELECT members.pic FROM members INNER JOIN users ON members.u_id = users.id WHERE users.username = '$username'";
                        $querypic = $conn->query($getpic);
                        $pic = $querypic->fetch_assoc();
                        
            ?>
                <img src="<?php echo $pic['pic'] ?>" class="ppu rounded-circle">
            </div>
            <div class="col acc-names">
                <h1 style="font-size: 50px;"><b><?php echo strtoupper($_SESSION['username']); ?></b></h1>

                <p>ACCOUNT'S LEVEL: <b><?php echo strtoupper($role);?></b></p>
            </div>
        </section>
        
        <section class="settings-box">
            <div class="settings-inner">
                <form action="usersettings.php" method="POST">
                    <div class="row">
                        <div class="col form-group">
                            <label for="fname">First Name</label>
                            <input type="text" name="fname" id="fname" value="<?php echo $fname; ?>"><br>
                        </div>

                        <div class="col uname">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" value="<?php echo $_SESSION['username']; ?>"><br>
                        </div>
                        
                    </div>
                    <br>
                    <div class="row">
                        <div class="col float-right">
                        <label for="lname">Last Name</label>
                        <input type="text" name="lname" id="lname" value="<?php echo $lname; ?>"><br>
                        </div>
                        <div class="col"></div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender">
                                <option value="1"  >Male</option>
                                <option value="2">Female</option>
                            </select><br>
                        </div>
                        <div class="col"></div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" value="<?php echo $email; ?>">
                        </div>
                        <div class="col"></div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="p-num">Phone Number</label>
                            <input type="number" name="p-num" id="p-num" value="<?php echo $pnumber; ?>">
                        </div>
                        <div class="col"></div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                        <label for="pass">Password</label>
                        <input type="password" name="pass" id="pass">
                        </div>
                        <div class="col">
                            <input type="submit" name="submit" value="UPDATE">
                        </div>
                    </div>


                </form>
            </div>
        </section>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

        <script>

            $( "#back" ).click(function() {
                window.open('userbook.php', "_self"); 
            });

            $( "#logout" ).click(function() {
                window.open('index.html', "_self"); 
            });
            
           
        </script>
    </body>
</html>