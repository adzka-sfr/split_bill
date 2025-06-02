<?php
include '../../config.php';
// Check if the user is logged in
if (!isset($_SESSION['sb_id'])) {
    echo 'not_logged_in';
    exit();
}

// get data post
$sb_id = $_SESSION['sb_id'];
$trip_id = $_POST['trip_id'] ?? '';

// get list member by trip id
$stmt = $conn->prepare("SELECT id, c_name FROM t_member WHERE c_trip = ?");
$stmt->bind_param("s", $trip_id);
$stmt->execute();
$result = $stmt->get_result();

?>
<option value="" disabled></option>
<?php
while ($row = $result->fetch_assoc()) {

?>
    <option value="<?= $row['id'] ?>"><?= $row['c_name'] ?></option>
<?php
}
