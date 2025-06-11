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
$item_name = isset($_POST['item_name']) ? $_POST['item_name'] : '';
$item_price = isset($_POST['item_price']) ? $_POST['item_price'] : '';
$item_owners = isset($_POST['item_owners'])
    ? (is_array($_POST['item_owners'])
        ? $_POST['item_owners']
        : explode(',', $_POST['item_owners']))
    : [];

// Remove empty values and duplicates if needed
$item_owners = array_filter(array_map('trim', $item_owners), function ($val) {
    return $val !== '';
});

if (count($item_owners) > 0) {
    // insert new owners
    $stmt = $conn->prepare("INSERT INTO t_owner (c_transaction, c_owner) VALUES (?, ?)");
    foreach ($item_owners as $owner_id) {
        $stmt->bind_param("si", $transaction_id, $owner_id);
        if (!$stmt->execute()) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to insert new owners.'
            ]);
            exit();
        }
    }
}

// update transaction details
$stmt = $conn->prepare("UPDATE t_transaction SET c_detail = ?, c_price = ? WHERE id = ?");
$stmt->bind_param("sis", $item_name, $item_price, $transaction_id);
if (!$stmt->execute()) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to update transaction details.'
    ]);
    exit();
}

echo json_encode([
    'status' => 'success',
    'message' => 'Transaction updated successfully.'
]);
