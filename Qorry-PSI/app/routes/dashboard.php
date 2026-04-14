<?php

if (isset($_SESSION[$akses]) == true) {
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
        $dataPage = [
            "panel" => "Home",
            "page" => "Dashboard"
        ];

        include 'app/view/page/dashboard/dashboard.php';
    } elseif ($page == "Logout") {
        # code...
        session_destroy();
        echo $fungsi->Redirect('?a=Login');
    } elseif ($page == "Pengguna") {
        # code...
        $dataPage = [
            "panel" => "Data",
            "page" => "Data Pengguna"
        ];

        include 'app/view/page/dashboard/data_pengguna.php';
    } elseif ($page == "Karyawan") {
        # code...
        $dataPage = [
            "panel" => "Data",
            "page" => "Data Karyawan"
        ];

        include 'app/view/page/dashboard/data_karyawan.php';
    } elseif ($page == "Nilai") {
        # code...
        $dataPage = [
            "panel" => "Data",
            "page" => "Data Penilaian"
        ];

        include 'app/view/page/dashboard/data_nilai.php';
    } elseif ($page == "Kriteria") {
        # code...
        $dataPage = [
            "panel" => "SPK",
            "page" => "Kriteria"
        ];

        include 'app/view/page/dashboard/spk_kriteria.php';
    } elseif ($page == "Sub") {
        # code...
        $dataPage = [
            "panel" => "SPK",
            "page" => "Sub Kriteria"
        ];

        include 'app/view/page/dashboard/spk_sub.php';
    } elseif ($page == "PSI") {
        # code...
        $dataPage = [
            "panel" => "SPK",
            "page" => "Metode Preference Selection Index (PSI)"
        ];

        include 'app/view/page/dashboard/spk_psi.php';
    } elseif ($page == "Hasil") {
        # code...
        $dataPage = [
            "panel" => "SPK",
            "page" => "Hasil Perhitungan Metode PSI"
        ];

        include 'app/view/page/dashboard/spk_hasil.php';
    } elseif ($page == "DataKeputusan") {
        # code...
        $dataPage = [
            "panel" => "Data",
            "page" => "Data Keputusan"
        ];

        include 'app/view/page/dashboard/data_keputusan.php';
    } elseif ($page == "Laporan") {
        # code...
        $dataPage = [
            "panel" => "Laporan",
            "page" => "Laporan Pemilihan Karyawan Terbaik"
        ];

        include 'app/view/page/dashboard/laporan.php';
    } else {
        # code...
        echo $fungsi->Redirect('?p=Dashboard');
    }
} else {
    # code...
    echo $fungsi->Redirect('?a=Login');
}