<?php 

$conn = new mysqli("localhost", "root", "", "mbsadmin");

if($conn->connect_error) {
    echo "FAILED!!!!!!";
    exit(-1);
    $conn -> close();
}
?>