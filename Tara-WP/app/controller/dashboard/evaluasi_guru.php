<?php

$no = 0;
$total_nilai = 0;
$id_guru = $dataPengguna['id_pengguna'];

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

$dataIndikator = [
    [
        "indikator" => "Sangat Baik",
        "nilai" => 5
    ],
    [
        "indikator" => "Baik",
        "nilai" => 4
    ],
    [
        "indikator" => "Cukup Baik",
        "nilai" => 3
    ],
    [
        "indikator" => "Kurang Baik",
        "nilai" => 2
    ],
    [
        "indikator" => "Tidak Baik",
        "nilai" => 1
    ]
];


$jumlah_indikator = mysqli_num_rows($queryKriteria);

if (isset($_POST['cek'])) {
    # code...
    $semester = $_POST['semester'];
    $periode = $_POST['periode'];

    $queryCekPenilaian = $crud->read(
        "penilaian",
        "INNER JOIN pengguna ON penilaian.id_pengguna = pengguna.id_pengguna
         INNER JOIN kriteria ON penilaian.kode_kriteria = kriteria.kode_kriteria
         INNER JOIN kompetensi ON penilaian.kode_kompetensi = kompetensi.kode_kompetensi
         WHERE 
         penilaian.id_pengguna = '$id_guru' AND
         penilaian.semester = '$semester' AND 
         penilaian.periode = '$periode'"
    );
}
