<?php
session_start();
include 'db_connection.php';

if (isset($_POST['txn_ref']) && $_POST['status'] == 'success') {
    $txn_ref = $_POST['txn_ref'];
    $sql = "UPDATE users SET payment_status='Paid' WHERE transaction_id='$txn_ref'";
    
    if ($conn->query($sql) === TRUE) {
        // Redirect or Show Success
        echo "<script>alert('Payment Confirmed! Account Active.'); window.location.href='dashboard.html';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    header("Location: index.php");
}
?>