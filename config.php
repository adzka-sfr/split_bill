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

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'split_bill';

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


// base_url
// $_SESSION['base_url'] = "http://10.105.48.12/hikari-lte";
$_SESSION['base_url'] = "//localhost/split_bill";
// $_SESSION['base_url'] = "//localhost:8080/hikari-lte";
// $_SESSION['base_url'] = "//WINDB-R550/hikari-lte";
function base_url($url = null)
{
    // $base_url = "http://10.105.52.131/hikari-lte";
    // $base_url = "http://WINDB-R550/hikari-lte";
    $base_url = "//localhost/split_bill";
    // $base_url = "//localhost:8080/hikari-lte";
    if ($url != null) {
        return $base_url . "/" . $url;
    } else {
        return $base_url;
    }
}
