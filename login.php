<?php 

    session_start();

    require_once('config.php');
    $conn = db();
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    
    $GET_PASS = "SELECT passwords FROM users WHERE email = '$email'";
    $GET_USER = "SELECT username FROM users WHERE email = '$email'";
 

    if(empty($user_res = $_POST['g-recaptcha-response'])) {
        ?>
        <script>
        alert("Captcha not entered!");
        window.location.href = "user-login.html";
    </script> <?php

    } else {
        
        $site_key = "6LffzX0aAAAAAHIJigNaUYGe1f-9w1K18HrCDnF9";
        $validate = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$site_key.'&response='.$user_res);
        $validate_data = json_decode($validate);

        if(!$validate_data->success) { ?>
            <script>
                alert("Captcha Verification Failed!");
                window.location.href = "user-login.html";
            </script> 
        <?php
        }
    }

    $query = $conn->query($GET_PASS);
    $row1 = $query->fetch_assoc();
    $STORED_HASH = $row1['passwords'];
    
    if (password_verify($password, $STORED_HASH)) {

        session_start();
        $session_id = session_create_id();

        $query2 = $conn->query($GET_USER);
        $row2 = $query2->fetch_assoc();
        $USER = $row2['username'];

        $_SESSION['log_in'] = True;
        $_SESSION['username'] = $USER;
        $_SESSION['id'] = $session_id;

        header("location: dashboard.php");
        exit();
    
    } else { ?>

        <script>
        alert("Invalid email or password!");
        window.location.href = "user-login.html";
        </script>
        <?php 
        die();
    }


?>