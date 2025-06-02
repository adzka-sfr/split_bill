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
$destination_id = $_POST['destination_id'] ?? '';

// Validate participant_id
if (empty($destination_id) || !is_numeric($destination_id)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid participant ID.'
    ]);
    exit();
}

// delete from t_destination, t_transaction, and t_owner
$stmt = $conn->prepare("DELETE d, t, o FROM t_destination d LEFT JOIN t_transaction t ON d.id = t.c_destination LEFT JOIN t_owner o ON t.id = o.c_transaction WHERE d.id = ?");
$stmt->bind_param("i", $destination_id);
$stmt->execute();
// Check if the deletion was successful
if ($stmt->affected_rows > 0) {
    // success
    echo json_encode([
        'status' => 'success',
        'message' => 'Destination has been deleted.'
    ]);
} else {
    // error
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to delete destination.'
    ]);
}
