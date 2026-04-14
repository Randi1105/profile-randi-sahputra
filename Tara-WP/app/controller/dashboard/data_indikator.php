<?php

$no = 1;
$queryIndikator = $crud->read(
    "indikator",
    "ORDER BY kode_indikator ASC"
);

$queryKriteria = $crud->read(
    "kriteria",
    "ORDER BY kode_kriteria ASC"
);

if (isset($_POST['tambah'])) {
    # code...
    $queryCekIndikator = $crud->read(
        "indikator",
        "WHERE kode_indikator = '$_POST[kode_indikator]'"
    );

    if (mysqli_num_rows($queryCekIndikator) > 0) {
        # code...
        echo $fungsi->NotifRedirect(
            "Gagal Tambah Data",
            "Mohon maaf, Kode Indikator yang anda masukan sudah digunakan",
            "error",
            "?p=" . $page
        );
    } else {
        # code...
        $crud->create(
            "indikator",
            "kode_kriteria, kode_indikator, nama_indikator",
            "'$_POST[kode_kriteria]', '$_POST[kode_indikator]', '$_POST[nama_indikator]'"
        );

        echo $fungsi->Redirect("?p=" . $page);
    }
}

if (isset($_POST['edit'])) {
    # code...
    $crud->update(
        "indikator",
        "kode_kriteria='$_POST[kode_kriteria]', kode_indikator='$_POST[kode_indikator]', nama_indikator='$_POST[nama_indikator]'",
        "id_indikator = '$_POST[id_indikator]'"
    );

    echo $fungsi->Redirect("?p=" . $page);
}

if (isset($_POST['hapus'])) {
    # code...
    $crud->delete(
        "indikator",
        "id_indikator",
        $_POST['id_indikator']
    );

    $crud->delete(
        "kategori",
        "id_indikator",
        $_POST['id_indikator']
    );

    echo $fungsi->Redirect("?p=" . $page);
}
