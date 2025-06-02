<?php
require "config.php";
if (isset($_SESSION['sb_id'])) {
    echo "<script>window.location='" . base_url('dashboard') . "';</script>";
} else {
    echo "<script>window.location='" . base_url('auth') . "';</script>";
}
