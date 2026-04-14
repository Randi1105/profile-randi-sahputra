<?php

$no = 1;
$queryGuru = $crud->read(
    "pengguna",
    "WHERE jabatan = 'Karyawan' ORDER BY jabatan ASC"
);
