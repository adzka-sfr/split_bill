<?php
include "../config.php";

// get data post
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// check if username and password are provided
if ($username && $password) {
    // check if username already exists
    $checkUser = mysqli_query($conn, "SELECT * FROM t_user WHERE c_name='$username' AND c_password='$password'");
    if (mysqli_num_rows($checkUser) > 0) {
        $_SESSION['sb_id'] = mysqli_fetch_assoc($checkUser)['id'];
        echo "success";
    } else {
        echo "not_found";
    }
} else {
    echo "Invalid request!";
}
