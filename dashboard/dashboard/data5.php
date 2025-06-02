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
$trip_id = isset($_POST['trip_id']) ? $_POST['trip_id'] : null;
$destination_name = isset($_POST['destination_name']) ? $_POST['destination_name'] : null;
$payer_id = isset($_POST['payer_id']) ? $_POST['payer_id'] : null;

// insert destination to database
if ($trip_id && $destination_name && $payer_id) {
    $stmt = $conn->prepare("INSERT INTO t_destination (c_user, c_name, c_datetime, c_trip, c_payer) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isssi", $sb_id, $destination_name, $now, $trip_id, $payer_id);

    if ($stmt->execute()) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Destination added successfully.'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to add destination.'
        ]);
    }

    $stmt->close();
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid input data.'
    ]);
}
