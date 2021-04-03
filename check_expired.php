<?php 
    $conn = db();

    $DateNow = date('Y-m-d H:i:s');
    $sql = "SELECT date IF(date <= $DateNow, UPDATE orders SET status = 'expired', NULL)
            FROM orders";
    
    $query = $conn->query($sql);
    var_dump($DateNow);    
?>