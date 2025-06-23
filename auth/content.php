<?php
if ($_GET['page'] == 'login') {
    include "login/index.php";
} else if ($_GET['page'] == 'check') {
    include "check/index.php";
}  else {
    include "login/index.php";
}
