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

// get data post
$sb_id = $_SESSION['sb_id'];
$trip_name = $_POST['trip_name'] ?? '';
$partisipants = $_POST['participants'] ?? '';

// breakdown participants into an array
$participants_array = explode(',', $partisipants);
// trim each participant name
$participants_array = array_map('trim', $participants_array);

// create unique trip ID
$trip_id = uniqid($sb_id . '_', true);

// insert trip into database
$stmt = $conn->prepare("INSERT INTO t_trip (id, c_user, c_name, c_datetime) VALUES (?, ?, ?, ?)");
$stmt->bind_param("siss", $trip_id, $sb_id, $trip_name, $now);
$stmt->execute();

// insert participants into database
foreach ($participants_array as $participant) {
    $participant = trim($participant);
    if (!empty($participant)) {
        $stmt = $conn->prepare("INSERT INTO t_member (c_user, c_name, c_trip) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $sb_id, $participant, $trip_id);
        $stmt->execute();
    }
}

if ($stmt->affected_rows > 0) {
    // success
    echo json_encode([
        'status' => 'success',
        'message' => 'Trip and participants added successfully.'
    ]);
} else {
    // error
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to add trip or participants.'
    ]);
}
