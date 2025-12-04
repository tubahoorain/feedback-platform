<?php
session_start();
include 'db_connection.php'; // Database connect karein

// Check karein ke URL mein ID aayi hai ya nahi
if (isset($_GET['id'])) {
    
    $id = intval($_GET['id']); // ID ko number mein convert karein (Security ke liye)

    // 1. Pehle check karein ke kahin ye Main Admin toh nahi?
    // Hum admin ko delete hone se rokna chahte hain
    $check_sql = "SELECT role FROM users1 WHERE id = $id";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($row['role'] == 'admin') {
            // Agar Admin hai toh error dikhayen aur wapas bhej dein
            echo "<script>
                alert('Security Alert: You cannot delete the Super Admin account!');
                window.location.href = 'superadmin.php';
            </script>";
            exit(); 
        } else {
            // 2. Agar Admin nahi hai, toh delete kar dein
            $delete_sql = "DELETE FROM users1 WHERE id = $id";

            if ($conn->query($delete_sql) === TRUE) {
                // Success: Wapas superadmin page par bhej dein
                header("Location: superadmin.php?msg=deleted");
                exit();
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        }
    } else {
        echo "User not found.";
    }
} else {
    // Agar ID nahi mili toh wapas bhej dein
    header("Location: superadmin.php");
}
?>