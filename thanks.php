<?php

    require_once('./script/config.php');
    $conn = db();
    $fname = $conn->real_escape_string($_POST['fname']);
    $lname = $conn->real_escape_string($_POST['lname']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $email = $conn->real_escape_string($_POST['email']);
    $pnumber = $conn->real_escape_string($_POST['p-num']);
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $fname = strtoupper($fname);
    $lname = strtoupper($lname);
    $options = [
        'memory_cost' => 2048,
        'time_cost' => 4
    ];

    $hash = password_hash($password, PASSWORD_ARGON2I,$options);
    
    $user = "INSERT INTO users(username,passwords,email,created_by,updated_by) VALUES('$username','$hash','$email','$username','$username')";
    
    $get_id = "SELECT id FROM users ORDER BY id DESC LIMIT 1";
    

    $send1 = $conn->query($user);

    $get = $conn->query($get_id);
    $result1 = $get->fetch_assoc();
    $id_res = $result1['id'];
    $member = "INSERT INTO members(firstname,lastname,sex,phone,u_id) VALUES('$fname','$lname','$gender','$pnumber','$id_res')";
    $send2 = $conn->query($member);
?>

<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" href="css/thanks.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>

        <div class="shape1"></div>
        
        <section class="admin-text">
            <h1 class="regist">THANK YOU <?php echo $lname.' '.$fname ?> FOR REGISTER</h1>
            <p style="font-weight: lighter; font-size: 20px; text-align: left; width:700px;">Please check your email withing 5 - 10 minutes to receive an email from us.
                If you have any problem please email us on MBS@email.com<br><a href="user-login.html">Login</a></p>
        </section>
        

        

        <script src="" async defer></script>
    </body>
</html>