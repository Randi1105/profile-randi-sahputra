<?php

$no = 1;
$queryKompetensi = $crud->read(
    "kompetensi",
    "ORDER BY kode_kompetensi ASC"
);

if (isset($_POST['tambah'])) {
    # code...
    $crud->create(
        "kompetensi",
        "kode_kompetensi, nama_kompetensi",
        "'$_POST[kode_kompetensi]', '$_POST[nama_kompetensi]'"
    );

    echo $fungsi->Redirect("?p=" . $page);
}

if (isset($_POST['edit'])) {
    # code...
    $crud->update(
        "kompetensi",
        "nama_kompetensi='$_POST[nama_kompetensi]'",
        "kode_kompetensi = '$_POST[kode_kompetensi]'"
    );

    echo $fungsi->Redirect("?p=" . $page);
}

if (isset($_POST['hapus'])) {
    # code...
    $crud->delete(
        "kompetensi",
        "kode_kompetensi",
        $_POST['kode_kompetensi']
    );

    echo $fungsi->Redirect("?p=" . $page);
}
