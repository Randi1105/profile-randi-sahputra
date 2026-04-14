<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Head -->
    <?php include 'app/view/layout/head.php' ?>
    <!-- \Head -->
</head>

<body style="background-color: #fff; font-family: 'Times New Roman', Times, serif;">

    <!-- Controller -->
    <?php include 'app/controller/report/cetak_laporan.php' ?>
    <!-- \Controller -->

    <div class="row">
        <div class="col-12 mb-3">
            <img src="assets/img/KOP11.png" class="mx-auto d-block" width="100%" height="200">
            <hr>
        </div>
        <div class="col-12 mb-4">
            <h2 class="font-weight-bolder text-center text-uppercase">
                Laporan Penilaian Kinerja Karyawan Menggunakan <br> Metode Weighted Product <br>
                <?= $dataProject['project'] ?>
            </h2>
        </div>
        <div class="col-12 mb-5">
            <table class="table table-bordered text-center border-dark">
                <thead>
                    <tr>
                        <th class="align-middle">Ranking</th>
                        <th class="align-middle">NIP </th>
                        <th class="align-middle">Nama Karyawan</th>
                        <?php foreach ($queryKompetensi as $row) : ?>
                        <th><?= $row['nama_kompetensi'] ?></th>
                        <?php endforeach ?>
                        <th class="align-middle">Total Nilai</th>
                        <th class="align-middle">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($dataHasil as $row) : ?>
                    <?php $cekGuru = mysqli_num_rows($crud->read("penilaian", "WHERE id_pengguna = '$row[id]' AND semester = '$semester' AND periode = '$periode'")); ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['nip'] ?></td>
                        <td><?= $row['nama'] ?></td>
                        <?php foreach ($queryKompetensi as $rowk) : ?>
                        <td><?= $cekGuru >= 12 ? round($wp->VektorS_Kometensi($row['id'], $rowk['kode_kompetensi'], $semester, $periode), 4) : '-' ?>
                        </td>
                        <?php endforeach ?>
                        <td><?= $cekGuru >= 12 ? $row['total_nilai'] : '-' ?></td>
                        <td><?= $cekGuru >= 12 ? $row['keputusan'] : '-' ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="col-12">
            <div class="d-flex justify-content-end">
                <div class="d-block">
                    <p>
                        Padang, <?= $fungsi->TanggalIndo(date('Y-m-d')) ?> <br>
                        Kepala Kanwil
                    </p>
                    <br>
                    <br>
                    <br>
                    <br>
                    <p class="font-weight-bold">
                        <ins><?= $dataKepala['nama_pengguna'] ?></ins> <br>
                        NIP .<?= $dataKepala['nip'] ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
    window.print()
    </script>
</body>

</html>