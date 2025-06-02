<?php
include '../../config.php';
// Check if the user is logged in
if (!isset($_SESSION['sb_id'])) {
    echo "<script>window.location='" . base_url('auth/') . "';</script>";
    exit();
}

// unset session sb_id
unset($_SESSION['sb_id']);
// Redirect to login page
echo "<script>window.location='" . base_url('auth/') . "';</script>";
exit();
