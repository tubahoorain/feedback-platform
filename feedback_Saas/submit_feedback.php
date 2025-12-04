<?php
include 'db_connection.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // JSON Data Receive
    $data = json_decode(file_get_contents("php://input"), true);

    // Validation
    if (!isset($data['company_id']) || !isset($data['rating'])) {
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
        exit;
    }

    // Data Sanitize
    $company_id = intval($data['company_id']);
    $name = $conn->real_escape_string($data['name']);
    $comment = $conn->real_escape_string($data['comment']);
    $rating = intval($data['rating']);
    $type = $conn->real_escape_string($data['type']);
    
    // Tags (Array to String convert karein)
    $tags = "";
    if (isset($data['tags']) && is_array($data['tags'])) {
        $tags = $conn->real_escape_string(implode(',', $data['tags']));
    }

    // Insert Query (company_id zaroor hona chahiye)
    $sql = "INSERT INTO feedbacks (company_id, customer_name, rating, comment, selected_tags, feedback_type, created_at) 
            VALUES ('$company_id', '$name', '$rating', '$comment', '$tags', '$type', NOW())";

    if ($conn->query($sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Feedback saved']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'DB Error: ' . $conn->error]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid Request']);
}
?>