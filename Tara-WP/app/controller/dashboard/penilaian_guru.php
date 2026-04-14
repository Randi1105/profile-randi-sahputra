<?php

$no = 1;
$queryGuru = $crud->read(
    "pengguna",
    "WHERE jabatan = 'Karyawan' ORDER BY jabatan ASC"
);

$queryPenilaian = $crud->read(
    "penilaian",
    "INNER JOIN pengguna ON penilaian.id_pengguna = pengguna.id_pengguna
     INNER JOIN kriteria ON penilaian.kode_kriteria = kriteria.kode_kriteria
     INNER JOIN kompetensi ON penilaian.kode_kompetensi = kompetensi.kode_kompetensi
     WHERE pengguna.jabatan = 'Karyawan'"
);
