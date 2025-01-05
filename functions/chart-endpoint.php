<?php

$configPath = __DIR__ . '/../config.php';
if (!file_exists($configPath)) {
    die('Config file not found: ' . $configPath);
}
require $configPath;

header('Content-Type: application/json');

$data = [];

$sql = "SELECT day_of_week, COUNT(*) as count from availability_schedule GROUP BY day_of_week";

$result = $db->query($sql);

while($row = $result->fetch_assoc()) {
        $data[$row['day_of_week']] = $row['count'];
}

echo json_encode($data);