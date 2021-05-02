<?php 
    session_start();
    require_once('../script/config.php');
    $conn=db();
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $GET_HASH = "SELECT passwords FROM users WHERE username = '$username'";
    $GET_ROLE = "SELECT roles FROM users WHERE username = '$username'";

    $ROLE_QUERY = $conn->query($GET_ROLE);
    $ROLES = $ROLE_QUERY->fetch_assoc();

    if($ROLES['roles'] == 1) {
        $HASH_QUERY = $conn->query($GET_HASH);
        $STORED_HASH = $HASH_QUERY->fetch_assoc();

    
        if(password_verify($password, $STORED_HASH['passwords'])) {

            session_start();
            $session_id = session_create_id();

            $_SESSION['username'] = $username;
            $_SESSION['log_in'] = True;
            $_SESSION['id'] = $session_id;

            header("location: ../dashboard.php");
            exit();
        } else {
            ?> 
            <script>
                alert("INVALID PASSWORD!");
                window.location.href = "admin-login.html";
            </script> <?php
        }
    } else {
        ?> 
        <script>
            alert("INVALID USERNAME!");
            window.location.href = "admin-login.html";
        </script> <?php
    }

    

?>