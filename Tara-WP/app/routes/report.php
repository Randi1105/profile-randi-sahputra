<?php
if (isset($_SESSION['login_rifo']) == true) {
    if ($page == "Laporan") {
        # code...
        include 'app/view/page/report/cetak_laporan.php';
    } elseif ($page == "CetakEvaluasi") {
        # code...
        include 'app/view/page/report/cetak_evaluasi.php';
    } elseif ($page == "CetakGuru") {
        # code...
        include 'app/view/page/report/cetak_guru.php';
    } else {
        # code...
        echo $fungsi->Redirect('?a=Login');
    }
} else {
    # code...
    echo $fungsi->Redirect('?a=Login');
}
