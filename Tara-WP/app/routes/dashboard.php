<?php

if (isset($_SESSION['login_rifo']) == true) {
    # code...
    $jabatan = $_SESSION['jabatan'];
    $id_pengguna = $_SESSION['id_pengguna'];

    $dataPengguna = mysqli_fetch_array(
        $crud->read(
            "pengguna",
            "WHERE id_pengguna = '$id_pengguna'"
        )
    );

    if ($page == "Dashboard") {
        # code...
        include 'app/view/page/dashboard/dashboard.php';
    } elseif ($page == "Logout") {
        # code...
        session_destroy();
        echo $fungsi->Redirect('?a=Login');
    } elseif ($page == "DataPengguna") {
        # code...
        include 'app/view/page/dashboard/data_pengguna.php';
    } elseif ($page == "DataGuru") {
        # code...
        include 'app/view/page/dashboard/data_guru.php';
    } elseif ($page == "DataKompetensi") {
        # code...
        include 'app/view/page/dashboard/data_kompetensi.php';
    } elseif ($page == "DataKriteria") {
        # code...
        include 'app/view/page/dashboard/data_kriteria.php';
    } elseif ($page == "DataIndikator") {
        # code...
        include 'app/view/page/dashboard/data_indikator.php';
    } elseif ($page == "ProsesWP") {
        # code...
        include 'app/view/page/dashboard/proses_wp.php';
    } elseif ($page == "WP") {
        # code...
        include 'app/view/page/dashboard/metode_wp.php';
    } elseif ($page == "PenilaianGuru") {
        # code...
        include 'app/view/page/dashboard/penilaian_guru.php';
    } elseif ($page == "Nilai") {
        # code...
        include 'app/view/page/dashboard/nilai.php';
    } elseif ($page == "Laporan") {
        # code...
        include 'app/view/page/dashboard/laporan.php';
    } elseif ($page == "Evaluasi") {
        # code...
        include 'app/view/page/dashboard/evaluasi_guru.php';
    } else {
        # code...
        echo $fungsi->Redirect('?p=Dashboard');
    }
} else {
    # code...
    echo $fungsi->Redirect('?a=Login');
}
