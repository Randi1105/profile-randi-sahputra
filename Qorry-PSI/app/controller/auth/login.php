<?php

if (isset($_POST['login'])) {
    # code...
    $username = $_POST['username'];
    $password = $_POST['password'];

    $queryAuth = $crud->read(
        "pengguna",
        "WHERE username = '$username' AND password = '$password'"
    );

    if (mysqli_num_rows($queryAuth) > 0) {
        # code...
        $dataAuth = mysqli_fetch_array($queryAuth);

        $_SESSION[$akses] = true;
        $_SESSION['id_pengguna'] = $dataAuth['id_pengguna'];
        $_SESSION['jabatan'] = $dataAuth['jabatan'];

        echo $fungsi->NotifRedirect(
            "Berhasil Login",
            "Selamat Datang " . $dataAuth['nama_pengguna'],
            "success",
            "?p=Dashboard"
        );
    } else {
        # code...
        echo $fungsi->NotifRedirect(
            "Gagal Login",
            "Mohon maaf, akun anda tidak ditemukan",
            "error",
            "?h=Home"
        );
    }
}
