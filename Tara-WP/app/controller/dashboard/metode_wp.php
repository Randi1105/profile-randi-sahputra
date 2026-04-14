<?php

$no = 1;
$total_bobot = 0;
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

foreach ($queryKriteria as $row) {
    # code...
    $total_bobot += $row['bobot_kriteria'];
}

if (isset($_POST['cek'])) {
    # code...
    $semester = $_POST['semester'];
    $periode = $_POST['periode'];
    $cekData = $crud->read(
        "penilaian",
        "WHERE semester = '$semester' AND periode = '$periode'"
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
