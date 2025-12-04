<?php
// Session start karna zaroori hai login check ke liye
session_start();

// Database connection file include karein
include 'db_connection.php';

// Headers set karein taa ke browser isay JSON samjhe
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

// Action parameter check karein
$action = isset($_GET['action']) ? $_GET['action'] : '';

// =========================================================
// PUBLIC ACCESS BLOCK (Customer Page ke liye)
// =========================================================
// Agar action 'fetch_public' hai, toh hum LOGIN CHECK NAHI karenge.
if ($action == 'fetch_public') {
    
    if(!isset($_GET['company_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Company ID missing in URL']);
        exit;
    }

    $pub_id = intval($_GET['company_id']); // URL se ID uthayi (e.g. ?id=5)

    $response = [];

    // 1. Settings layen (Sirf us company ki)
    $sql_set = "SELECT company_name, primary_color, module_type, logo_base64 FROM company_settings WHERE company_id = '$pub_id' LIMIT 1";
    $res_set = $conn->query($sql_set);
    
    if($res_set && $res_set->num_rows > 0) {
        $response['settings'] = $res_set->fetch_assoc();
    } else {
        // Fallback Default Settings
        $response['settings'] = [
            'company_name' => 'Feedback System',
            'primary_color' => '#4F46E5',
            'module_type' => 'star',
            'logo_base64' => ''
        ];
    }

    // 2. Parameters layen
    $params = [];
    $sql_param = "SELECT param_name FROM feedback_parameters WHERE company_id = '$pub_id'";
    $res_param = $conn->query($sql_param);
    
    if($res_param) {
        while($row = $res_param->fetch_assoc()) {
            $params[] = $row;
        }
    }
    $response['parameters'] = $params;

    // NOTE: Hum yahan FEEDBACKS nahi bhej rahe, kyunke customer ko dusron ke msg nahi dikhne chahiye.

    echo json_encode($response);
    exit; // Yahin ruk jayen (Login check par na jayen)
}

// =========================================================
// SECURITY CHECK (Admin Actions ke liye)
// =========================================================
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "Unauthorized: Please login first"]);
    exit();
}

$company_id = $_SESSION['user_id']; // Logged in Admin ki ID

// =========================================================
// ACTION 1: FETCH ALL DATA (Admin Dashboard ke liye)
// =========================================================
if ($action == 'fetch_all') {
    $response = [];

    // A. Settings Fetch
    $settings_sql = "SELECT * FROM company_settings WHERE company_id = '$company_id' LIMIT 1";
    $settings_result = $conn->query($settings_sql);
    
    if ($settings_result->num_rows > 0) {
        $response['settings'] = $settings_result->fetch_assoc();
    } else {
        // Agar naya user hai, Default settings create karein
        $default_name = $_SESSION['company_name'] ?? 'My Company';
        $insert_sql = "INSERT INTO company_settings (company_id, company_name) VALUES ('$company_id', '$default_name')";
        $conn->query($insert_sql);
        
        $response['settings'] = [
            'company_name' => $default_name,
            'primary_color' => '#4F46E5',
            'module_type' => 'star',
            'logo_base64' => null
        ];
    }

    // B. Parameters Fetch
    $params = [];
    $param_sql = "SELECT * FROM feedback_parameters WHERE company_id = '$company_id' ORDER BY id ASC";
    $param_result = $conn->query($param_sql);
    while($row = $param_result->fetch_assoc()) {
        $params[] = $row;
    }
    $response['parameters'] = $params;

    // C. Feedbacks Fetch (Sirf is company ke)
    $feedbacks = [];
    $feed_sql = "SELECT * FROM feedbacks WHERE company_id = '$company_id' ORDER BY created_at DESC";
    $feed_result = $conn->query($feed_sql);
    if($feed_result) {
        while($row = $feed_result->fetch_assoc()) {
            $feedbacks[] = $row;
        }
    }
    $response['feedbacks'] = $feedbacks;

    echo json_encode($response);
    exit;
}

// =========================================================
// ACTION 2: UPDATE SETTINGS (Called by Admin)
// =========================================================
if ($action == 'update_settings' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = json_decode(file_get_contents("php://input"), true);
    
    $comp = $conn->real_escape_string($input['company_name']);
    $color = $conn->real_escape_string($input['primary_color']);
    $mod = $conn->real_escape_string($input['module']); 
    
    // Logo Logic
    $logo_query_part = "";
    if (isset($input['logo_base64']) && !empty($input['logo_base64'])) {
        $logo = $conn->real_escape_string($input['logo_base64']);
        $logo_query_part = ", logo_base64='$logo'";
    }

    // Check if record exists
    $check = $conn->query("SELECT id FROM company_settings WHERE company_id = '$company_id'");

    if ($check->num_rows > 0) {
        // Update
        $sql = "UPDATE company_settings SET 
                company_name='$comp', 
                primary_color='$color', 
                module_type='$mod' 
                $logo_query_part 
                WHERE company_id='$company_id'";
    } else {
        // Insert
        $logo_val = isset($input['logo_base64']) ? $input['logo_base64'] : '';
        $sql = "INSERT INTO company_settings (company_id, company_name, primary_color, module_type, logo_base64) 
                VALUES ('$company_id', '$comp', '$color', '$mod', '$logo_val')";
    }

    if($conn->query($sql)) {
        echo json_encode(["status" => "success", "message" => "Settings updated"]);
    } else {
        echo json_encode(["status" => "error", "message" => $conn->error]);
    }
    exit;
}

// =========================================================
// ACTION 3: MANAGE PARAMETERS (Add/Edit/Delete)
// =========================================================
if ($action == 'manage_params' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = json_decode(file_get_contents("php://input"), true);
    $type = $input['type'];

    if($type == 'add') {
        $name = $conn->real_escape_string($input['name']);
        if(!empty($name)) {
            $conn->query("INSERT INTO feedback_parameters (company_id, param_name) VALUES ('$company_id', '$name')");
        }
    } 
    elseif($type == 'delete') {
        $id = intval($input['id']);
        // Security: Sirf apni company ka parameter delete ho
        $conn->query("DELETE FROM feedback_parameters WHERE id=$id AND company_id='$company_id'");
    }
    elseif($type == 'edit') {
        $id = intval($input['id']);
        $name = $conn->real_escape_string($input['name']);
        $conn->query("UPDATE feedback_parameters SET param_name='$name' WHERE id=$id AND company_id='$company_id'");
    }

    echo json_encode(["status" => "success"]);
    exit;
}
// =========================================================
// ACTION 4: RESET DATA (Delete All Feedbacks)
// =========================================================
if ($action == 'reset_data' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // 1. Delete All Feedbacks for this company
    $sql_feed = "DELETE FROM feedbacks WHERE company_id = '$company_id'";
    
    // 2. Optional: Delete Parameters too (Agar parameters bhi udane hain to neeche wali line uncomment karein)
    // $sql_param = "DELETE FROM feedback_parameters WHERE company_id = '$company_id'";
    // $conn->query($sql_param);

    if ($conn->query($sql_feed)) {
        echo json_encode(["status" => "success", "message" => "All data cleared successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database error: " . $conn->error]);
    }
    exit;
}
$conn->close();
?>