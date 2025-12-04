<?php
session_start();
include 'db_connection.php';

// Check if superadmin is logged in
// if(!isset($_SESSION['role']) || $_SESSION['role'] != 'superadmin') { exit('Access Denied'); }

if (isset($_GET['id']) && isset($_GET['email'])) {
    $user_id = $_GET['id'];
    $user_email = $_GET['email'];

    // 1. Update Status to Active
    $sql = "UPDATE users1 SET status = 'active' WHERE id = $user_id";
    
    if ($conn->query($sql) === TRUE) {
        
        // 2. Send Email (Simple PHP Mail)
        $to = $user_email;
        $subject = "Account Approved - FeedbackSaaS";
        $message = "Congratulations! Your account has been approved by the Superadmin.\n\nYou can now login to your dashboard: http://yourwebsite.com/index.php";
        $headers = "From: no-reply@feedbacksaas.com";

        mail($to, $subject, $message, $headers);

        // Redirect back
        echo "<script>alert('User Approved & Email Sent!'); window.location.href='superadmin.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>