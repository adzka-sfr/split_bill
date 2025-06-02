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
$destination_id = $_POST['destination_id'] ?? '';
$item_name = $_POST['item_name'] ?? '';
$item_price = $_POST['item_price'] ?? '';
$owner_type = $_POST['owner_type'] ?? '';
$item_owners = isset($_POST['item_owners']) ? (is_array($_POST['item_owners']) ? implode(',', $_POST['item_owners']) : $_POST['item_owners']) : '';
$trip_id = $_POST['trip_id'] ?? '';

// create unique transaction ID
$transaction_id = $destination_id . '_' . uniqid('item_', true);

// insert to t_transaction
$stmt = $conn->prepare("INSERT INTO t_transaction (id, c_user, c_trip, c_detail, c_price, c_destination) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sissss", $transaction_id, $sb_id, $trip_id, $item_name, $item_price, $destination_id);
$stmt->execute();



// check owner type
if ($owner_type === 'all') {
    // get all member in active trip
    $stmt = $conn->prepare("SELECT id FROM t_member WHERE c_trip = ?");
    $stmt->bind_param("s", $trip_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $member_ids = [];
    while ($row = $result->fetch_assoc()) {
        $member_ids[] = $row['id'];
    }

    // insert to t_owner
    $stmt = $conn->prepare("INSERT INTO t_owner (c_transaction, c_owner) VALUES (?, ?)");
    foreach ($member_ids as $member_id) {
        $stmt->bind_param("si", $transaction_id, $member_id);
        $stmt->execute();
    }
} else {
    // if owner type is specific, use only selected members
    $item_owners = explode(',', $item_owners);

    // insert to t_owner
    $stmt = $conn->prepare("INSERT INTO t_owner (c_transaction, c_owner) VALUES (?, ?)");
    foreach ($item_owners as $owner_id) {
        $stmt->bind_param("si", $transaction_id, $owner_id);
        $stmt->execute();
    }
}

// check if data inserted successfully
if ($stmt->affected_rows > 0) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Item added successfully.',
        'transaction_id' => $transaction_id
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to add item.'
    ]);
}
