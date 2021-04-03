<?php 
    require_once('config.php');
    include'authorized.php';
    $conn = db();
    
    $username = $_SESSION['username'];
    $id = $conn->real_escape_string($_POST['cancel']);
   

    
    if(empty($id)){
        echo "empty";    
    } else {
        CancelBook($id, $username);
    }

    function CancelBook($id, $username) {
        $conn = db();
        $sql = "UPDATE orders SET status = 'canceled' WHERE id = $id AND username = '$username'";
   
        if($conn->query($sql) === TRUE) {
            echo "<script>alert('Booking Successfully Canceled'); window.location.href = 'booking.php';</script>";
        } else {
            echo "<script>alert('".$username."'); window.location.href = 'booking.php';</script>";
        }
    }

    function RescheduleBook() {
        $conn = db();
        $sql = "UPDATE orders SET dates = $date WHERE id = ";
    }
    
?>
