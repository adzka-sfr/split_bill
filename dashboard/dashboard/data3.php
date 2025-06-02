<?php
include '../../config.php';
// Check if the user is logged in
if (!isset($_SESSION['sb_id'])) {
    echo json_encode([
        'status' => 'not_logged_in',
        'message' => 'User not logged in.'
    ]);
    exit();
}

// get sb_id from session
$sb_id = $_SESSION['sb_id'];

// get last trip data
$stmt = $conn->prepare("SELECT id, c_name, c_datetime FROM t_trip WHERE c_user = ? ORDER BY c_datetime DESC LIMIT 1");
$stmt->bind_param("i", $sb_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $trip = $result->fetch_assoc();
    echo json_encode([
        'status' => 'success',
        'trip' => [
            'id' => $trip['id'],
            'name' => $trip['c_name'],
            'datetime' => $trip['c_datetime']
        ]
    ]);
} else {
    echo json_encode([
        'status' => 'trip_not_found',
        'message' => 'No trips found for this user.'
    ]);
}
$stmt->close();
$conn->close();
