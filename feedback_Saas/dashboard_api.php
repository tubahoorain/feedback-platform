<?php
session_start();
header('Content-Type: application/json');

// Database Connection
$host = 'localhost'; $dbname = 'feedback-saas'; $user = 'root'; $pass = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
} catch(PDOException $e) { echo json_encode(['status'=>'error']); exit; }

$user_id = 1; // Testing ke liye ID 1
$action = $_POST['action'] ?? '';

// 1. Get All Data
if ($action === 'get_dashboard_data') {
    $settings = $pdo->prepare("SELECT * FROM company_settings WHERE user_id=?");
    $settings->execute([$user_id]);
    
    $params = $pdo->prepare("SELECT * FROM parameters WHERE user_id=? ORDER BY id DESC");
    $params->execute([$user_id]);

    $feedbacks = $pdo->prepare("SELECT * FROM feedbacks WHERE user_id=? ORDER BY created_at DESC");
    $feedbacks->execute([$user_id]);

    $stats = $pdo->prepare("SELECT COUNT(*) as total, AVG(rating) as avg FROM feedbacks WHERE user_id=?");
    $stats->execute([$user_id]);
    $statData = $stats->fetch();

    echo json_encode([
        'status' => 'success',
        'settings' => $settings->fetch(PDO::FETCH_ASSOC),
        'parameters' => $params->fetchAll(PDO::FETCH_ASSOC),
        'feedbacks' => $feedbacks->fetchAll(PDO::FETCH_ASSOC),
        'stats' => ['total' => $statData['total'], 'avg' => round($statData['avg'], 1)]
    ]);
    exit;
}

// 2. Add Parameter
if ($action === 'add_parameter') {
    $name = $_POST['name'];
    $stmt = $pdo->prepare("INSERT INTO parameters (user_id, name) VALUES (?, ?)");
    $stmt->execute([$user_id, $name]);
    echo json_encode(['status'=>'success']); exit;
}

// 3. Edit Parameter (Ye naya feature hai)
if ($action === 'edit_parameter') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $stmt = $pdo->prepare("UPDATE parameters SET name=? WHERE id=? AND user_id=?");
    $stmt->execute([$name, $id, $user_id]);
    echo json_encode(['status'=>'success']); exit;
}

// 4. Delete Parameter
if ($action === 'delete_parameter') {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM parameters WHERE id=? AND user_id=?");
    $stmt->execute([$id, $user_id]);
    echo json_encode(['status'=>'success']); exit;
}

// 5. Save Customization (Logo Fix included)
if ($action === 'save_customization') {
    $company = $_POST['company_name'];
    $color = $_POST['primary_color'];
    $module = $_POST['feedback_module'];
    
    // File Upload Logic
    $logoSql = "";
    $params = [$company, $color, $module];
    
    if(isset($_FILES['logo']) && $_FILES['logo']['error'] == 0){
        if(!is_dir('uploads')) mkdir('uploads');
        $path = "uploads/" . time() . "_" . $_FILES['logo']['name'];
        move_uploaded_file($_FILES['logo']['tmp_name'], $path);
        $logoSql = ", logo_path=?";
        $params[] = $path;
    }
    
    $params[] = $user_id;
    
    // Check insert or update
    $check = $pdo->prepare("SELECT * FROM company_settings WHERE user_id=?");
    $check->execute([$user_id]);
    
    if($check->rowCount() > 0){
        $sql = "UPDATE company_settings SET company_name=?, primary_color=?, feedback_module=? $logoSql WHERE user_id=?";
    } else {
        $sql = "INSERT INTO company_settings (company_name, primary_color, feedback_module, logo_path, user_id) VALUES (?, ?, ?, ?, ?)";
        // Adjust logic slightly for insert if needed, but update handles most cases for existing user
    }
    
    $pdo->prepare($sql)->execute($params);
    echo json_encode(['status'=>'success']); exit;
}
?>