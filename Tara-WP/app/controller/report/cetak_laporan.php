<?php

$no = 1;
$semester = $_GET['semester'];
$periode = $_GET['periode'];

$dataKepala = mysqli_fetch_array(
    $crud->read(
        "pengguna",
        "WHERE jabatan = 'Kepala'"
    )
);

$queryGuru = $crud->readGroup(
    "penilaian",
    "penilaian.id_pengguna, pengguna.nama_pengguna, pengguna.nip",
    "INNER JOIN pengguna ON pengguna.id_pengguna = penilaian.id_pengguna
     GROUP BY penilaian.id_pengguna
     ORDER BY penilaian.id_pengguna ASC"
);

$queryKriteria = $crud->read(
    "kriteria",
    "ORDER BY LENGTH(kode_kriteria) ASC"
);

$queryKompetensi = $crud->read(
    "kompetensi",
    "ORDER BY kode_kompetensi ASC"
);

foreach ($queryGuru as $row) {
    # code...
    $id_penilaian = $row['id_pengguna'];
    $nip = $row['nip'];
    $nama = $row['nama_pengguna'];
    $total_nilai = round($wp->VektorV_Kompetensi($row['id_pengguna'], $semester, $periode), 5);
    $keputusan = $wp->Keputusan($wp->VektorV_Kompetensi($row['id_pengguna'], $semester, $periode));

    $dataHasil[] = [
        "id" => $id_penilaian,
        "nip" => $nip,
        "nama" => $nama,
        "total_nilai" => $total_nilai,
        "keputusan" => $keputusan
    ];

    usort($dataHasil, fn($a, $b) => $b['total_nilai'] <=> $a['total_nilai']);
}
