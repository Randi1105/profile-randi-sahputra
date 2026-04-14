<?php

$queryPengguna = $crud->read(
    "pengguna",
    "ORDER BY jabatan "
);

$querykaryawan = $crud->read(
    "karyawan",
    "ORDER BY id_karyawan"
);

$queryPenilaian = $crud->read(
    "nilai",
    "ORDER BY id_nilai "
);

$queryKriteria = $crud->read(
    "kriteria",
    "ORDER BY kode_kriteria "
);