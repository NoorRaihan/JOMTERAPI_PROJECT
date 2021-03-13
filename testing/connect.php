<?php 

$conn = new mysqli("localhost", "root", "", "contohdatalegoom");

if($conn->connect_error) {
    echo "FAILED!!!!!!";
    exit(-1);
    $conn -> close();
}


$input = $_POST['bandar'];

$sql = "INSERT INTO cities(bandar) VALUES('$input')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

$conn -> close();
?>