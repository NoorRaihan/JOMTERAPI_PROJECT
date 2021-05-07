<?php
    require_once('config.php');
    include'../include/authorized.php';
    $conn = db();

    $id = intval($_POST['done']);
    $sql = "UPDATE orders set status = 'done' WHERE id = $id";

    $query = $conn->query($sql);
    
    if($query === TRUE){
        echo "<script>alert('Booking successfully approved!');window.location.href = '../client.php'</script>";
    } else {
        echo "<script>alert('Booking approvement failed!');window.location.href = '../lient.php'</script>";
    }

?>