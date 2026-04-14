<?php

$no = 1;
$total_bobot = 0;
$total_relatif = 0;

$queryKompetensi = $crud->read(
    "kompetensi",
    "ORDER BY kode_kompetensi ASC"
);

$queryKriteria = $crud->read(
    "kriteria",
    "ORDER BY LENGTH(kode_kriteria) ASC"
);

foreach ($queryKriteria as $row) {
    # code...
    $total_bobot += $row['bobot_kriteria'];
}

if (isset($_POST['tambah'])) {
    # code...
    $queryCekKriteria = $crud->read(
        "kriteria",
        "WHERE kode_kriteria = '$_POST[kode_kriteria]'"
    );

    if (mysqli_num_rows($queryCekKriteria) > 0) {
        # code...
        echo $fungsi->NotifRedirect(
            "Gagal Tambah Data",
            "Mohon maaf, Kode Kriteria yang anda masukan sudah digunakan",
            "error",
            "?p=" . $page
        );
    } else {
        # code...
        $crud->create(
            "kriteria",
            "kode_kompetensi, kode_kriteria, nama_kriteria, bobot_kriteria",
            "'$_POST[kode_kompetensi]', '$_POST[kode_kriteria]', '$_POST[nama_kriteria]', '$_POST[bobot_kriteria]'"
        );

        echo $fungsi->Redirect("?p=" . $page);
    }
}

if (isset($_POST['edit'])) {
    # code...
    $crud->update(
        "kriteria",
        "kode_kompetensi='$_POST[kode_kompetensi]', kode_kriteria='$_POST[kode_kriteria]', nama_kriteria='$_POST[nama_kriteria]', bobot_kriteria='$_POST[bobot_kriteria]'",
        "kode_kriteria = '$_POST[kode_kriteria]'"
    );

    echo $fungsi->Redirect("?p=" . $page);
}

if (isset($_POST['hapus'])) {
    # code...
    $crud->delete(
        "kriteria",
        "kode_kriteria",
        $_POST['kode_kriteria']
    );

    echo $fungsi->Redirect("?p=" . $page);
}
