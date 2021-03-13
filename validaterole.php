<?php 
    require_once('config.php');
    $session_user = $_SESSION['username'];
    $sql = "SELECT roles FROM users WHERE username = '$session_user'";
    $query = $conn->query($sql);
    $result = $query->fetch_assoc();
    $role = $result['roles'];
?>