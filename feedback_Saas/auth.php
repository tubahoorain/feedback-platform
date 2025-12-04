<?php
session_start();
include 'db_connection.php';

// --- REGISTER LOGIC ---
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'register') {
    $company = $_POST['company_name'];
    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $payment_method = $_POST['payment_method'];
    
    // Stripe Token ya Transaction ID (Easypaisa/Jazzcash)
    $trx_id = isset($_POST['stripeToken']) ? "Stripe_Paid" : ($_POST['transaction_id'] ?? 'Pending_Verification');

    // Check duplicate email
    $check = $conn->query("SELECT id FROM users1 WHERE email = '$email'");
    if ($check->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Email already exists']);
        exit;
    }

    // Insert with STATUS = 'pending'
    $sql = "INSERT INTO users1 (company_name, full_name, email, password, payment_method, transaction_id, status) 
            VALUES ('$company', '$name', '$email', '$pass', '$payment_method', '$trx_id', 'pending')";

    if ($conn->query($sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Account created! Please wait for Superadmin approval.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error']);
    }
    exit;
}

// --- LOGIN LOGIC ---
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'login') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users1 WHERE email = '$email'");
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // 1. Password Check
        if (password_verify($password, $row['password'])) {
            
            // 2. APPROVAL CHECK (Superadmin Logic)
            if ($row['status'] == 'pending') {
                echo json_encode(['status' => 'error', 'message' => 'Account pending approval. Waiting for Admin verification.']);
                exit;
            }

            // Login Success
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['company_name'] = $row['company_name'];
            $_SESSION['role'] = $row['role']; // 'admin' or 'superadmin'

            // Redirect based on role
            $redirect = ($row['role'] == 'superadmin') ? 'superadmin.php' : 'admin.php';
            
            echo json_encode(['status' => 'success', 'redirect' => $redirect]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid password']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User not found']);
    }
    exit;
}
?>