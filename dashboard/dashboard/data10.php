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

// get list owner by transaction id
$sql = "SELECT o.c_owner, m.c_name FROM t_owner o LEFT JOIN t_member m ON o.c_owner = m.id WHERE o.c_transaction = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $transaction_id);
$stmt->execute();
$result = $stmt->get_result();
$owners = [];
while ($row = $result->fetch_assoc()) {
    $owners[] = [
        'c_owner' => $row['c_owner'],
        'c_name' => $row['c_name']
    ];
}
$stmt->close();

?>

<table class="table table-bordered">
    <thead style="text-align: center;">
        <tr>
            <th>Owner</th>
            <th style="width: 5%;">Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($owners as $owner): ?>
            <tr>
                <td>
                    <?php echo htmlspecialchars($owner['c_name']); ?>
                    <input type="hidden" name="owner[]" value="<?php echo htmlspecialchars($owner['c_owner']); ?>">
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm delete-owner" onclick="deleteOwner('<?php echo htmlspecialchars($owner['c_owner']); ?>')">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>