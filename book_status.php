<?php 
    require_once('config.php');
    include'authorized.php';
    $conn = db();
    
    $username = $_SESSION['username'];
    $id_cancel = $conn->real_escape_string($_POST['cancel'] ?? 'empty');
    $id_reschedule = $conn->real_escape_string($_POST['updateid']);
    $date = $conn->real_escape_string(date("Y-m-d H:i:s", strtotime($_POST['reschedule-date'])));
    

    
    if($id_cancel != 'empty'){
        CancelBook($id_cancel, $username);
    } else {
        RescheduleBook($id_reschedule,$date,$username);
    }

    function CancelBook($id, $username) {
        $conn = db();
        $sql = "UPDATE orders SET status = 'canceled' WHERE id = $id AND username = '$username'";
   
        if($conn->query($sql) === TRUE) {
            echo "<script>alert('Booking Successfully Canceled'); window.location.href = 'booking.php';</script>";
        } else {
            echo "failed";
            var_dump($id_cancel);
        }
    }

    function RescheduleBook($id_reschedule,$date,$username) {
        $conn = db();
        $sql = "UPDATE orders SET dates = '$date' WHERE id = $id_reschedule AND username = '$username'";
        
        if($conn->query($sql) === TRUE) {
             echo "<script>alert('Booking Successfully Rescheduled'); window.location.href = 'booking.php';</script>";
        } else {
            echo "<script>alert('Failed to Reschedule!); window.location.href = 'booking.php';</script>";
        }
    }
    
?>
