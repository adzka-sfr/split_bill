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
$participant_id = $_POST['participant_id'] ?? '';

// Validate participant_id
if (empty($participant_id) || !is_numeric($participant_id)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid participant ID.'
    ]);
    exit();
}

// Prepare and execute the delete statement
$stmt = $conn->prepare("DELETE FROM t_member WHERE id = ?");
$stmt->bind_param("i", $participant_id);
$stmt->execute();
// Check if the deletion was successful
if ($stmt->affected_rows > 0) {
    // success
    echo json_encode([
        'status' => 'success',
        'message' => 'Participant has been deleted.'
    ]);
} else {
    // error
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to delete participant.'
    ]);
}
