<?php

$no = 1;
$id = $_GET['id'];
$queryKategori = $crud->read(
    "kategori",
    "WHERE id_indikator = '$id'"
);

$dataIndikator = mysqli_fetch_array(
    $crud->read(
        "indikator",
        "WHERE id_indikator = '$id'"
    )
);

if (isset($_POST['tambah'])) {
    # code...
    $crud->create(
        "kategori",
        "id_indikator, nama_kategori, nilai",
        "'$id', '$_POST[nama_kategori]', '$_POST[nilai]'"
    );

    echo $fungsi->Redirect("?p=" . $page . "&id=" . $id);
}

if (isset($_POST['edit'])) {
    # code...
    $crud->update(
        "kategori",
        "nama_kategori='$_POST[nama_kategori]', nilai='$_POST[nilai]'",
        "id_kategori = '$_POST[id_kategori]'"
    );

    echo $fungsi->Redirect("?p=" . $page . "&id=" . $id);
}

if (isset($_POST['hapus'])) {
    # code...
    $crud->delete(
        "kategori",
        "id_kategori",
        $_POST['id_kategori']
    );

    echo $fungsi->Redirect("?p=" . $page . "&id=" . $id);
}
