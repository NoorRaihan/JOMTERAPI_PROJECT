<?php 

    require_once('./script/config.php');

    $user = $_POST['delete'];

    $sql = "DELETE FROM members WHERE u_id IN (SELECT id FROM users WHERE id = $user)"; 
    $sql2 = "DELETE FROM users WHERE id = $user";
    
    if($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE) {
        ?>
       <script>
           alert("Data for successfully deleted!");
           window.location.href = "regisclient.php";
       </script> <?php
   } else { ?>

       <script>
       alert("ERROR");
       window.location.href = "regisclient.php";
       </script>
       <?php
   }

    
?>