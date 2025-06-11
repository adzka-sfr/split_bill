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
$transaction_id = isset($_POST['transaction_id']) ? $_POST['transaction_id'] : '';

// delete transaction by id
$sql = "DELETE t, o FROM t_transaction t LEFT JOIN t_owner o ON t.id = o.c_transaction WHERE t.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $transaction_id);
if ($stmt->execute()) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Transaction deleted successfully.'
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to delete transaction.'
    ]);
}
