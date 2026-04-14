<?php

if (isset($_GET['p'])) {
    # code...
    $page = $_GET['p'];

    include 'app/routes/dashboard.php';
}

if (isset($_GET['a'])) {
    # code...
    $page = $_GET['a'];

    include 'app/routes/auth.php';
}

if (isset($_GET['r'])) {
    # code...
    $page = $_GET['r'];

    include 'app/routes/report.php';
}

if (!isset($_GET['p']) and !isset($_GET['a']) and !isset($_GET['r'])) {
    # code...
    echo $fungsi->Redirect('?a=Login');
}
