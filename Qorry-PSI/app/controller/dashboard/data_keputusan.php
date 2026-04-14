<?php

$no = 1;
$queryKeputusan = $crud->read(
    "keputusan",
    "ORDER BY max DESC"
);

if (isset($_POST['tambah'])) {
    # code...
    $cekDataKeputusan = $crud->read(
        "keputusan",
        "WHERE jabatan = '$_POST[jabatan]'"
    );

    if (mysqli_num_rows($cekDataKeputusan) > 0) {
        # code...
        echo $fungsi->NotifRedirect(
            "Gagal Tambah Data",
            "posisi Sudah Dinilai",
            "error",
            "?p=" . $page
        );
    } else {
        # code...
        $crud->create(
            "keputusan",
            "posisi, min, max",
            "'$_POST[posisi]', '$_POST[min]', '$_POST[max]'"
        );

        echo $fungsi->Redirect("?p=" . $page);
    }
}

if (isset($_POST['edit'])) {
    # code...
    $crud->update(
        "keputusan",
        "posisi='$_POST[posisi]', min='$_POST[min]', max='$_POST[max]'",
        "id_keputusan = '$_POST[id_keputusan]'"
    );

    echo $fungsi->Redirect("?p=" . $page);
}

if (isset($_POST['hapus'])) {
    # code...
    $crud->delete(
        "keputusan",
        "id_keputusan",
        $_POST['id_keputusan']
    );

    echo $fungsi->Redirect("?p=" . $page);
}