<?php
if (isset($_SESSION[$akses]) == true) {
    if ($page == "Laporan") {
        # code...
        include 'app/view/page/report/cetak_laporan.php';
    } else {
        # code...
        echo $fungsi->Redirect('?a=Login');
    }
} else {
    # code...
    echo $fungsi->Redirect('?a=Login');
}