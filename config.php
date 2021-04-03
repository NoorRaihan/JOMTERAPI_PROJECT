<?php 


// $conn = new mysqli("localhost", "root", "", "mbsadmin");

// if($conn->connect_error) {
//     echo "FAILED!!!!!!";
//     exit(-1);
//     $conn -> close();
// }

function db() {
    static $conn;
    $conn = new mysqli("localhost", "root", "", "mbsadmin");

        if($conn->connect_error) {
            echo "FAILED!!!!!!";
            exit(-1);
            $conn -> close();
        }
    return $conn;
}
?>