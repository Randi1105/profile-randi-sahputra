<?php

$no = 1;
$id_guru = $_GET['id'];

$queryGuru = $crud->read(
    "pengguna",
    "WHERE id_pengguna = '$id_guru'"
);

$dataGuru = mysqli_fetch_array($queryGuru);

$queryKompetensi = $crud->read(
    "kompetensi",
    "ORDER BY LENGTH(kode_kompetensi) ASC"
);

$queryPenilaian = $crud->read(
    "penilaian",
    "INNER JOIN pengguna ON penilaian.id_pengguna = pengguna.id_pengguna
     INNER JOIN kriteria ON penilaian.kode_kriteria = kriteria.kode_kriteria
     INNER JOIN kompetensi ON penilaian.kode_kompetensi = kompetensi.kode_kompetensi
     WHERE penilaian.id_pengguna = '$id_guru'"
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

if (isset($_POST['cek'])) {
    # code...
    $semester = $_POST['semester'];
    $periode = $_POST['periode'];
    $kode_kompetensi = $_POST['kode_kompetensi'];

    $queryKompetensi = $crud->read(
        "kompetensi",
        "WHERE kode_kompetensi = '$kode_kompetensi'"
    );

    $queryKriteria = $crud->read(
        "kriteria",
        "WHERE kode_kompetensi = '$kode_kompetensi'
         ORDER BY LENGTH(kode_kriteria) ASC"
    );

    $dataKompetensi = mysqli_fetch_array($queryKompetensi);
}

if (isset($_POST['submit'])) {
    # code...
    $queryKriteria = $crud->read(
        "kriteria",
        "WHERE kode_kompetensi = '$_POST[kode_kompetensi]'"
    );

    $i = 0;

    foreach ($queryKriteria as $row) {
        # code...
        $kode_kompetensi = $row['kode_kompetensi'];
        $kode_kriteria = $_POST['kode_kriteria'];
        $nilai = $_POST['nilai'];
        $semester = $_POST['semester'];
        $periode = $_POST['periode'];

        $queryCekNilai = $crud->read(
            "penilaian",
            "WHERE 
             id_pengguna = '$id_guru' AND 
             kode_kriteria = '$kode_kriteria[$i]' AND
             kode_kompetensi = '$kode_kompetensi' AND
             semester = '$semester' AND
             periode = '$periode'"
        );

        if (mysqli_num_rows($queryCekNilai) > 0) {
            # code...
            $crud->update(
                "penilaian",
                "nilai='$nilai[$i]'",
                "id_pengguna = '$id_guru' AND kode_kriteria = '$kode_kriteria[$i]' AND 
                 kode_kompetensi = '$kode_kompetensi' AND semester = '$semester' AND periode = '$periode'"
            );
        } else {
            # code...
            $crud->create(
                "penilaian",
                "id_pengguna, kode_kriteria, kode_kompetensi, nilai, semester, periode",
                "'$id_guru', '$kode_kriteria[$i]', '$kode_kompetensi', '$nilai[$i]', '$semester', '$periode'"
            );
        }
        $i++;
    }

    echo $fungsi->NotifRedirect(
        "Sukses Memberikan Penilaian",
        "",
        "success",
        "?p=Nilai&id=" . $id_guru
    );
}
