<?php

$conn = new mysqli("localhost","root","", "contohdatalegoom");

if (!$conn) {
    echo "Failed!";
}else {
    echo "success!";
}

$test = "SELECT bandar FROM cities ORDER BY id ASC ";

$ssql = $conn->query($test);

echo "<table>";
while ($row = $ssql->fetch_assoc()) {

    echo "<tr><td>".$row['bandar']."</td></tr>";
   
}
echo "</table>";

?>