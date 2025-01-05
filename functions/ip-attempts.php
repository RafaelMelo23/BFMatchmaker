<?php
$configPath = __DIR__ . '/../config.php'; // Required for the database connection
if (!file_exists($configPath)) {
    die('Config file not found: ' . $configPath);
}
require $configPath;  // Required for the database connection

function log_attempt($db, $ip, $success, $action) {
    $stmt = $db->prepare("INSERT INTO request_log (ip_address, request_time, success, action) VALUES (?, NOW(), ?, ?)");
    // Use TINYINT for the success value (1 for success, 0 for failure)
    $stmt->bind_param("sis", $ip, $success, $action); // "s" for string, "i" for integer
    $stmt->execute();
    $stmt->close();
}

function check_attempts($db, $ip, $action) {
    // Prepare the SQL query with a specific interval of 15 minutes
    $stmt = $db->prepare("SELECT COUNT(*) AS count FROM request_log WHERE ip_address = ? AND request_time > (NOW() - INTERVAL 15 MINUTE) AND action = ?");
    
    // Check if statement was prepared successfully
    if (!$stmt) {
        // Log or handle the error if statement preparation fails
        throw new Exception("Database error: Failed to prepare statement.");
    }

    // Bind parameters and execute
    $stmt->bind_param("ss", $ip, $action); // Bind IP address and action
    $stmt->execute();

    // Fetch the result
    $result = $stmt->get_result();
    if ($result) {
        $row = $result->fetch_assoc();
        $stmt->close();
        return (int)$row['count'];  // Return an integer for clearer type consistency
    } else {
        $stmt->close();
        throw new Exception("Database error: Failed to retrieve results.");
    }
}

function is_ip_blocked($db, $ip, $max_attempts, $action) {
    // Check the count of attempts for the given action in the last 15 minutes
    $attempt_count = check_attempts($db, $ip, $action);
    return $attempt_count >= $max_attempts;
}
?>
