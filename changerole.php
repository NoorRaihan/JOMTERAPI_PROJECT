<?php
    require_once('config.php');
    include'authorized.php';

    $conn = db();
    $id = intval($_POST['crole']);
    $role = intval($_POST['role']);

    $sql = "UPDATE users SET roles = $role WHERE id = $id";
    $query = $conn->query($sql);

    if($query) {
        echo "<script>alert('Successfully change the role!'); window.location.href = 'regisclient.php'</script>";
    } else {
        echo "<script>alert('Opps! Something went wrong...'); window.location.href = 'regisclient.php'</script>";
    }

?>