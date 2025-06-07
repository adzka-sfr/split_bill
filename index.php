<?php
if ($_SERVER['HTTP_HOST'] === 'localhost') {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/split_bill/config.php'; // local
} else {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php'; // hosting
}
if (isset($_SESSION['sb_id'])) {
    echo "<script>window.location='" . base_url('dashboard') . "';</script>";
} else {
    echo "<script>window.location='" . base_url('auth') . "';</script>";
}
