<?php
session_start();

$configPath = __DIR__ . '/../config.php';
if (!file_exists($configPath)) {
    sendResponse('error', 'Config file not found');
}
require $configPath;

function sendResponse($status, $message, $data = null) {
    header('Content-Type: application/json');
    $response = ['status' => $status, 'message' => $message];
    if ($data) {
        $response['data'] = $data;
    }
    echo json_encode($response);
    exit;
}

try {
    // Query to aggregate unique player counts per day and time slot, including user timezone
    $stmt = $db->prepare("SELECT a.day_of_week, a.time_slot, COUNT(DISTINCT a.user_id) as player_count, u.user_timezone
                          FROM availability_schedule a
                          JOIN game_availability u ON a.user_id = u.user_id
                          GROUP BY a.day_of_week, a.time_slot, u.user_timezone");
    $stmt->execute();

    // Retrieve results in a way compatible with both PDO and MySQLi
    $availabilityData = [];
    if (method_exists($stmt, 'fetchAll')) {
        // For PDO
        $availabilityData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // For MySQLi
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $availabilityData[] = $row;
        }
    }

    sendResponse('success', 'Data retrieved successfully', $availabilityData);

} catch (Exception $e) {
    sendResponse('error', 'An error occurred while fetching data.', $e->getMessage());
}
?>