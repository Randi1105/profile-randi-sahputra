<?php

$no = 1;
$queryKaryawan = $crud->read(
    "Karyawan",
    "ORDER BY id_karyawan ASC"
);

if (isset($_POST['tambah'])) {
    # code...
    $cekDataKaryawan = $crud->read(
        "Karyawan",
        "WHERE id_karyawan = '$_POST[id_karyawan]'"
    );

    if (mysqli_num_rows($cekDataKaryawan) > 0) {
        # code...
        echo $fungsi->NotifRedirect(
            "Gagal Tambah Data Karyawan",
            "Mohon maaf, id Karyawan yang anda masukan sudah ada",
            "error",
            "?p=" . $page
        );
    } else {
        # code...
        $crud->create(
            "Karyawan",
            "id_karyawan, jk_karyawan, nama_karyawan",
            "'$_POST[id_karyawan]', '$_POST[jk_karyawan]', '$_POST[nama_karyawan]'"
        );

        echo $fungsi->Redirect("?p=" . $page);
    }
}

if (isset($_POST['edit'])) {
    # code...
    $crud->update(
        "karyawan",
        "nama_karyawan='$_POST[nama_karyawan]', jk_karyawan='$_POST[jk_karyawan]'",
        "id_karyawan = '$_POST[id_karyawan]'"
    );

    echo $fungsi->Redirect("?p=" . $page);
}

if (isset($_POST['hapus'])) {
    # code...
    $crud->delete(
        "karyawan",
        "id_karyawan",
        $_POST['id_karyawan']
    );

    $crud->delete(
        "nilai",
        "id_karyawan",
        $_POST['id_karyawan']
    );

    echo $fungsi->Redirect("?p=" . $page);
}