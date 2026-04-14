<?php

$no = 1;
$queryGuru = $crud->read(
    "pengguna",
    "WHERE jabatan = 'Karyawan'"
);

$queryKriteria = $crud->read(
    "kriteria",
    "ORDER BY LENGTH(kode_kriteria) ASC"
);

$queryKompetensi = $crud->read(
    "kompetensi",
    "ORDER BY kode_kompetensi ASC"
);

if (isset($_POST['cek'])) {
    # code...
    $semester = $_POST['semester'];
    $periode = $_POST['periode'];

    // $queryPenilaian = $crud->read(
    //     "penilaian",
    //     "INNER JOIN pengguna ON penilaian.id_pengguna = pengguna.id_pengguna
    //      INNER JOIN kriteria ON penilaian.id_kriteria = kriteria.id_kriteria
    //      INNER JOIN indikator ON penilaian.id_indikator = indikator.id_indikator
    //      INNER JOIN kategori ON penilaian.id_kategori = kategori.id_kategori
    //      WHERE 
    //      pengguna.jabatan = 'Guru' AND 
    //      penilaian.semester = '$semester' AND 
    //      penilaian.periode = '$periode'"
    // );
}
