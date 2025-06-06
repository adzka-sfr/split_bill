<?php
// setting default timezone
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
$year = date('Y');
$year2 = date('y');
$month = date('m');
$date = date('d');
$day = date('l');
$day2 = date('D');

session_start();

if ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1') {
    // local
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'split_bill';
} else {
    // hosting
    $host = 'localhost'; // usually still localhost on most shared hosting
    $user = 'u266480338_split_bill';
    $database = 'u266480338_split_bill';
    $password = 'Ngapainribetjir!123';
}

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// check session
if (isset($_SESSION['session_id'])) {
    $session_status = 'active';
} else {
    $session_status = 'inactive';
}


// base url
function base_url($path = '')
{
    $is_https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
    $protocol = $is_https ? "https" : "http";
    // Use '/split_bill' for local (http), use '' for hosting (https)
    $base = $is_https ? $_SERVER['HTTP_HOST'] : $_SERVER['HTTP_HOST'] . '/split_bill';
    return $protocol . "://" . $base . "/" . ltrim($path, '/');
}

// For including PHP files, use the server's document root
function base_path($path = null)
{
    $base_path = $_SERVER['DOCUMENT_ROOT'] . '/split_bill/'; // local
    // $base_path = $_SERVER['DOCUMENT_ROOT']; // hosting
    if ($path != null) {
        return $base_path . '/' . trim($path, '/');
    } else {
        return $base_path;
    }
}
// tes git lewat git dekstop
