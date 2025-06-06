<?php
// require_once $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php'; // hosting
require_once $_SERVER['DOCUMENT_ROOT'] . '/split_bill/config.php'; // local
echo 'anjay';
if (isset($_SESSION['sb_id'])) {
    echo "<script>window.location='" . base_url('dashboard') . "';</script>";
} else {
    echo "<script>window.location='" . base_url('auth') . "';</script>";
}
