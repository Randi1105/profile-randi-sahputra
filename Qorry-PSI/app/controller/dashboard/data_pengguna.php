<?php

$no = 1;
$queryPengguna = $crud->read(
    "pengguna",
    "ORDER BY jabatan "
);

if (isset($_POST['tambah'])) {
    # code...
    $queryCekPengguna = $crud->read(
        "pengguna",
        "WHERE username = '$_POST[username]'"
    );

    if (mysqli_num_rows($queryCekPengguna) > 0) {
        # code...
        echo $fungsi->NotifRedirect(
            "Gagal Tambah Data",
            "Username Yang Anda Masukan Sudah Ada",
            "error",
            "?p=" . $page
        );
    } else {
        # code...
        $nmFoto = $_FILES['foto_pengguna']['name'];
        $lkFoto = $_FILES['foto_pengguna']['tmp_name'];
        $foto = $_POST['nama_pengguna'] . $nmFoto;
        $tmp = "assets/imgs/pengguna/" . $foto;

        if (move_uploaded_file($lkFoto, $tmp)) {
            # code...
            $crud->create(
                "pengguna",
                "username, password, nama_pengguna, jabatan, foto_pengguna",
                "'$_POST[username]', '$_POST[password]', '$_POST[nama_pengguna]', '$_POST[jabatan]', '$foto'"
            );
        }

        echo $fungsi->Redirect("?p=" . $page);
    }
}

if (isset($_POST['edit'])) {
    # code...
    $nmFoto = $_FILES['foto_pengguna']['name'];
    $lkFoto = $_FILES['foto_pengguna']['tmp_name'];
    $foto = $_POST['nama_pengguna'] . $nmFoto;
    $tmp = "assets/imgs/pengguna/" . $foto;

    if (!empty($nmFoto)) {
        # code...
        move_uploaded_file($lkFoto, $tmp);
        $foto_pengguna = ", foto_pengguna='$foto'";
    } else {
        # code...
        $foto_pengguna = "";
    }

    $crud->update(
        "pengguna",
        "username='$_POST[username]', password='$_POST[password]', nama_pengguna='$_POST[nama_pengguna]', 
         jabatan='$_POST[jabatan]' $foto_pengguna",
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

    echo $fungsi->Redirect("?p=" . $page);
}