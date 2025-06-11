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
$owner_id = isset($_POST['owner_id']) ? $_POST['owner_id'] : '';

// delete owner by id
$sql = "DELETE FROM t_owner WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $owner_id);
if ($stmt->execute()) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Owner deleted successfully.'
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to delete owner.'
    ]);
}