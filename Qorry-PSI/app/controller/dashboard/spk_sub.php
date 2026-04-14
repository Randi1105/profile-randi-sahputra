<?php

if (isset($_GET['Kode'])) {
    # code...
    $kode = $_GET['Kode'];
} else {
    # code...
    echo $fungsi->Redirect("?p=Kriteria");
}

$no = 1;

$querySub = $crud->read(
    "sub_kriteria",
    "WHERE kode_kriteria = '$kode' ORDER BY nilai_sub "
);

$dataKriteria = mysqli_fetch_array(
    $crud->read(
        "kriteria",
        "WHERE kode_kriteria = '$kode'"
    )
);

if (isset($_POST['tambah'])) {
    # code...
    $crud->create(
        "sub_kriteria",
        "kode_kriteria, nama_sub, nilai_sub",
        "'$kode', '$_POST[nama_sub]', '$_POST[nilai_sub]'"
    );

    echo $fungsi->Redirect("?p=" . $page . "&Kode=" . $kode);
}

if (isset($_POST['edit'])) {
    # code...
    $crud->update(
        "sub_kriteria",
        "nama_sub='$_POST[nama_sub]', nilai_sub='$_POST[nilai_sub]'",
        "id_sub = '$_POST[id_sub]'"
    );

    echo $fungsi->Redirect("?p=" . $page . "&Kode=" . $kode);
}

if (isset($_POST['hapus'])) {
    # code...
    $crud->delete(
        "sub_kriteria",
        "id_sub",
        $_POST['id_sub']
    );

    echo $fungsi->Redirect("?p=" . $page . "&Kode=" . $kode);
}