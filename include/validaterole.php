<?php 
    // require_once('./script/config.php');
    $conn = db();
    $session_user = $_SESSION['username'];
    $sql = "SELECT users.roles AS id, roles.roles FROM users JOIN roles ON roles.id = users.roles WHERE users.username = '$session_user'";
    $query = $conn->query($sql);
    $result = $query->fetch_assoc();
    $role = $result['roles'];
    $desc_role = $result['id'];
?>