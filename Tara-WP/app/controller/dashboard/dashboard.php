<?php

$queryGuru = $crud->read(
    "pengguna",
    "WHERE jabatan = 'Karyawan' ORDER BY jabatan ASC"
);

$queryPengguna = $crud->read(
    "pengguna",
    "ORDER BY jabatan ASC"
);

$queryKriteria = $crud->read(
    "kriteria",
    "ORDER BY kode_kriteria ASC"
);
