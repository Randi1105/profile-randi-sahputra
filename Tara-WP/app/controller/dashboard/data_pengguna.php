<?php

$no = 1;
$queryPengguna = $crud->read(
    "pengguna",
    "ORDER BY jabatan ASC"
);

if (isset($_POST['tambah'])) {
    # code...
    $crud->create(
        "pengguna",
        "username, password, nip, nama_pengguna, jabatan",
        "'$_POST[username]', '$_POST[password]', '$_POST[nip]', '$_POST[nama_pengguna]', '$_POST[jabatan]'"
    );

    echo $fungsi->Redirect("?p=" . $page);
}

if (isset($_POST['edit'])) {
    # code...
    $crud->update(
        "pengguna",
        "username='$_POST[username]', password='$_POST[password]', nip='$_POST[nip]', 
         nama_pengguna='$_POST[nama_pengguna]', jabatan='$_POST[jabatan]'",
        "id_pengguna = '$_POST[id_pengguna]'"
    );

    echo $fungsi->Redirect("?p=" . $page);
}

if (isset($_POST['hapus'])) {
    # code...
    $crud->delete(
        "pengguna",
        "id_pengguna",
        $_POST['id_pengguna']
    );

    $crud->delete(
        "penilaian",
        "id_pengguna",
        $_POST['id_pengguna']
    );

    echo $fungsi->Redirect("?p=" . $page);
}
