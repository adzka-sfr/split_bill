<?php
if ($_GET['page'] == 'dashboard') {
    include "dashboard/index.php";
} else if ($_GET['page'] == 'group') {
    include "group/index.php";
} else if ($_GET['page'] == 'bill') {
    include "bill/index.php";
} else if ($_GET['page'] == 'profile') {
    include "profile/index.php";
} else if ($_GET['page'] == 'logout') {
    include "logout/index.php";
} else {
    include "dashboard/index.php";
}
