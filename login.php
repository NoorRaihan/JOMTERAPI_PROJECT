<?php 

    session_start();

    require_once('config.php');

    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    // $options = [
    //     'memory_cost' => 2048,
    //     'time_cost' => 4
    // ];

    // $CURRENT_HASH = password_hash($password, PASSWORD_ARGON2I,$options);
    
    $GET_PASS = "SELECT passwords FROM users WHERE email = '$email'";
    $GET_USER = "SELECT username FROM users WHERE email = '$email'";
 
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