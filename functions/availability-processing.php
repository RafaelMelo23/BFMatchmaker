<?php
session_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

$configPath = __DIR__ . '/../config.php';
if (!file_exists($configPath)) {
    sendResponse('error', 'Config file not found');
}
require $configPath;

function sendResponse($status, $message, $debugInfo = null) {
    header('Content-Type: application/json');
    $response = ['status' => $status, 'message' => $message];
    if ($debugInfo && getenv('APP_ENV') === 'development') {
        $response['debug'] = $debugInfo;
    }
    echo json_encode($response);
    exit;
}

function validateEmailDomain($email) {
    $email = trim($email);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return ['status' => 'error', 'message' => 'Invalid email format.'];
    }

    $domain = substr(strrchr($email, "@"), 1);

    if ($domain && checkdnsrr($domain, "MX")) {
        return ['status' => 'success'];
    } else {
        return ['status' => 'error', 'message' => 'Domain does not have MX records.'];
    }
}

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        sendResponse('error', 'Invalid request method');
    }

    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        sendResponse('error', 'Invalid CSRF token');
    }

    $errors = []; 

    
    global $db;
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $submission_limit = 15;
    
    $submission_check_sql = "SELECT COUNT(*) AS submission_count FROM request_log WHERE ip_address = ? AND request_time > DATE_SUB(NOW(), INTERVAL 1 HOUR)";
    $submission_check_stmt = $db->prepare($submission_check_sql);
    $submission_check_stmt->bind_param("s", $user_ip);
    $submission_check_stmt->execute();
    $submission_check_stmt->bind_result($submission_count);
    $submission_check_stmt->fetch();
    $submission_check_stmt->close();
    
    if ($submission_count >= $submission_limit) {
        sendResponse('error', 'You have exceeded the limit of 9 submissions per hour.');
    }

    $email = $_POST['email'] ?? '';
    $emailValidation = validateEmailDomain($email);
    if ($emailValidation['status'] === 'error') {
        $errors[] = $emailValidation['message'];
    }

    $time_zone = $_POST['time_zone'] ?? '';
    $game_modes = $_POST['game_modes'] ?? [];
    $days = $_POST['days'] ?? [];

    if (empty($email)) $errors[] = 'Valid E-mail is required.';
    if (empty($time_zone)) $errors[] = 'Time zone is required.';
    if (empty($game_modes)) $errors[] = 'Select at least one game mode.';
    if (empty($days)) $errors[] = 'Select at least one day.';

    $anyTimeChecked = false;
    foreach ($days as $day) {
        if (!empty($_POST["{$day}_times"])) {
            $anyTimeChecked = true;
            break;
        }
    }
    if (!$anyTimeChecked) {
        $errors[] = 'Select at least one time for each day.';
    }

    if ($errors) sendResponse('error', $errors);

    if (!isset($db)) {
        throw new Exception("Error connecting to database.");
    }

    $timezone_map = [
        'EST' => 'America/New_York',
        'EDT' => 'America/New_York',
        'CST' => 'America/Chicago',
        'MST' => 'America/Denver',
        'PST' => 'America/Los_Angeles',
        'WET' => 'Europe/Lisbon',
        'CET' => 'Europe/Paris',
        'EET' => 'Europe/Athens',
        'BRT' => 'America/Sao_Paulo',
        'ART' => 'America/Argentina/Buenos_Aires',
        'CLT' => 'America/Santiago',
        'PET' => 'America/Lima',
        'PYT' => 'America/Asuncion',
        'JST' => 'Asia/Tokyo',
        'IST' => 'Asia/Kolkata',
        'AEST' => 'Australia/Sydney',
        'ACST' => 'Australia/Darwin',
        'AWST' => 'Australia/Perth',
        'NZST' => 'Pacific/Auckland'
    ];

    if (!isset($timezone_map[$time_zone])) {
        sendResponse('error', 'Invalid time zone.');
    }
    $timezone_name = $timezone_map[$time_zone];

    $insert_user_sql = "INSERT INTO game_availability (email, user_timezone) VALUES (?, ?) ON DUPLICATE KEY UPDATE user_timezone = VALUES(user_timezone)";
    $insert_user_stmt = $db->prepare($insert_user_sql);
    $insert_user_stmt->bind_param("ss", $email, $timezone_name);
    if (!$insert_user_stmt->execute()) {
        throw new Exception('Error inserting or updating user: ' . $insert_user_stmt->error);
    }

    if ($db->affected_rows === 1) {
        $user_id = $db->insert_id;
    } else {
        $select_user_sql = "SELECT user_id FROM game_availability WHERE email = ?";
        $select_user_stmt = $db->prepare($select_user_sql);
        $select_user_stmt->bind_param("s", $email);
        $select_user_stmt->execute();
        $select_user_stmt->bind_result($user_id);
        $select_user_stmt->fetch();
        $select_user_stmt->close();
    }

    foreach ($days as $day) {
        $time_slots = $_POST["{$day}_times"] ?? [];
        foreach ($time_slots as $time) {
            $sql_availability = "INSERT INTO availability_schedule (user_id, day_of_week, time_slot) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE time_slot = VALUES(time_slot)";
            $stmt_availability = $db->prepare($sql_availability);
            $stmt_availability->bind_param("iss", $user_id, $day, $time);
            if (!$stmt_availability->execute()) {
                throw new Exception('Error inserting availability: ' . $stmt_availability->error);
            }
        }
    }

    foreach ($game_modes as $mode) {
        $sql_mode = "INSERT INTO game_modes (user_id, game_mode) VALUES (?, ?) ON DUPLICATE KEY UPDATE game_mode = VALUES(game_mode)";
        $stmt_mode = $db->prepare($sql_mode);
        $stmt_mode->bind_param("is", $user_id, $mode);
        if (!$stmt_mode->execute()) {
            throw new Exception('Error inserting game mode: ' . $stmt_mode->error);
        }
    }

    $log_sql = "INSERT INTO request_log (ip_address, user_id, request_time, action) VALUES (?, ?, NOW(), 'form_submission')";
    $log_stmt = $db->prepare($log_sql);
    $log_stmt->bind_param("si", $user_ip, $user_id);
    if (!$log_stmt->execute()) {
        throw new Exception('Error logging request: ' . $log_stmt->error);
    }

    sendResponse('success', 'Form submitted successfully.');
    
} catch (Exception $e) {
    sendResponse('error', 'An error occurred.', $e->getMessage());
}
?>
