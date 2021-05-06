<?php 
    require_once('config.php');
    include'../include/authorized.php';
    $conn = db();
    
    $username = $_SESSION['username'];
    $time_ = new DateTime($_POST['reschedule-slot']?? '');
    $date_ = new DateTime($_POST['reschedule-date']?? '');
    $date_->setTime($time_->format('H'), $time_->format('i'), $time_->format('s'));
    $date = $date_->format('Y-m-d H:i:s');
    $id_cancel = $conn->real_escape_string($_POST['cancel'] ?? 'empty');
    $id_reschedule = $conn->real_escape_string($_POST['updateid']?? '');
    
    

    
    if($id_cancel != 'empty'){
        CancelBook($id_cancel, $username);
        $time_ = '';
        $date = '';
        $date_ = '';
        $id_reschedule = '';
    } else {
        echo "test";
    }

    function CancelBook($id, $username) {
        $conn = db();
        $sql = "UPDATE orders SET status = 'canceled' WHERE id = $id AND username = '$username'";
   
        if($conn->query($sql) === TRUE) {
            echo "<script>alert('Booking Successfully Canceled'); window.location.href = '../booking.php';</script>";
        } else {
            echo "failed";
            var_dump($id_cancel);
        }
    }

    function RescheduleBook($id_reschedule,$date,$username) {
        $conn = db();
        $sql = "UPDATE orders SET dates = '$date' WHERE id = $id_reschedule AND username = '$username'";
        echo "test";
        var_dump($sql);
        if($conn->query($sql) === TRUE) {
             echo "<script>alert('Booking Successfully Rescheduled'); window.location.href = 'booking.php';</script>";
        } else {
            echo "<script>alert('Failed to Reschedule!); window.location.href = '../booking.php';</script>";
        }
    }
    
?>
