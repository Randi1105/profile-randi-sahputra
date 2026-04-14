<?php

$no = 1;

$queryNilai = $crud->read(
    "nilai",
    "INNER JOIN karyawan ON nilai.id_karyawan = karyawan.id_karyawan
     ORDER BY nilai.id_karyawan "
);

$queryKaryawan = $crud->read(
    "karyawan",
    "ORDER BY id_karyawan "
);

$queryKriteria = $crud->read(
    "kriteria",
    "ORDER BY kode_kriteria "
);

if (isset($_POST['tambah'])) {
    # code...
    $cekPenilaian = $crud->read(
        "nilai",
        "WHERE id_karyawan = '$_POST[id_karyawan]' AND periode = '$_POST[periode]'"
    );

    if (mysqli_num_rows($cekPenilaian) > 0) {
        # code...
        echo $fungsi->NotifRedirect(
            "Informasi",
            "karyawan dengan $_POST[id_karyawan] pada periode $_POST[periode] sudah dinilai",
            "info",
            "?p=" . $page
        );
    } else {
        # code...
        $kode = $_POST['periode'] . "-" . date('his');
        $crud->create(
            "nilai",
            "id_nilai, id_karyawan, periode, C1, C2, C3, C4, C5",
            "'$kode', '$_POST[id_karyawan]', '$_POST[periode]', '$_POST[C1]', '$_POST[C2]', 
             '$_POST[C3]', '$_POST[C4]', '$_POST[C5]'"
        );

        echo $fungsi->Redirect("?p=" . $page);
    }
}

if (isset($_POST['edit'])) {
    # code...
    $crud->update(
        "nilai",
        "C1='$_POST[C1]', C2='$_POST[C2]', C3='$_POST[C3]', C4='$_POST[C4]', C5='$_POST[C5]'",
        "id_nilai = '$_POST[id_nilai]'"
    );

    echo $fungsi->Redirect("?p=" . $page);
}

if (isset($_POST['hapus'])) {
    # code...
    $crud->delete(
        "nilai",
        "id_nilai",
        $_POST['id_nilai']
    );

    echo $fungsi->Redirect("?p=" . $page);
}