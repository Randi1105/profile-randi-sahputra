<?php

if (isset($_POST['proses'])) {
    # code...
    $no = 1;
    $periode = $_POST['periode'];

    $queryNilai = $crud->read(
        "nilai",
        "INNER JOIN karyawan ON nilai.id_karyawan = karyawan.id_karyawan
         WHERE nilai.periode = '$periode'
         ORDER BY karyawan.id_karyawan ASC"
    );

    $querykaryawan = $crud->read(
        "karyawan",
        "ORDER BY id_karyawan "
    );

    $queryKriteria = $crud->read(
        "kriteria",
        "ORDER BY kode_kriteria "
    );

    if (mysqli_num_rows($queryNilai) > 0) {
        # code...

        foreach ($queryKriteria as $row) {
            $bobot[] = $spk->PembobotanKriteria($row);
        }

        foreach ($queryNilai as $row) {
            # code...
            $id = $row['id_nilai'];
            $id_karyawan = $row['id_karyawan'];
            $nama = $row['nama_karyawan'];
            $jk = $row['jk_karyawan'];
            $total_nilai = round($spk->PreferensiVektor($row, $bobot), 5);

            $dataHasil[] = [
                "id" => $id,
                "id_karyawan" => $id_karyawan,
                "nama" => $nama,
                "jk" => $jk,
                "total" => $total_nilai
            ];
        }

        usort($dataHasil, fn($a, $b) => $b['total'] <=> $a['total']);
    }
}