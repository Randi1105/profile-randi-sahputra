<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Head -->
    <?php include 'app/view/layout/head.php' ?>
    <!-- \Head -->
</head>

<body style="background-color: #fff; font-family: 'Times New Roman', Times, serif !important;">
    <!-- Contoller -->
    <?php include 'app/controller/report/cetak_laporan.php' ?>
    <!-- \Controller -->

    <div class="container-fluid">
        <div class="row">
            <img src="assets/imgs/Logo Honda.png" class="mx-auto d-block" width="50px" height="100px" alt="">
            <h5 class="text-center text-uppercase mt-5">Head Office : PT. HONDA AMANAH MOTOR beralamat di JL.Raya Padang
                -
                Pariaman Simpang 3 Jam Pungguang Kasiak.
                Hasil Perankingan Karyawan Terbaik Pada PT.Honda Amanah Motor Menggunakan Metode PSI
            </h5>
            <div class="col-12 mb-4">
                <h2 class="text-uppercase text-center fw-bolder" style="font-family: 'Times New Roman', Times, serif;">
                    Laporan Pemilihan Karyawan Terbaik PT. Honda Amanah Motor <br>
                    <?= $dataProject['project'] ?> <br>
                    Periode <?= $periode ?>
                </h2>
            </div>
            <div class="col-12 mb-4">
                <div>
                    <table class="table table-bordered text-center align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Penilaian</th>
                                <th>ID Karyawan</th>
                                <th>Nama Karyawan</th>
                                <th>Total Nilai</th>
                                <th>Keputusan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataHasil as $row) : $no++ ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $row['id_nilai'] ?></td>
                                    <td><?= $row['id_karyawan'] ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['total'] ?></td>
                                    <td><?= $spk->Keputusan($no) ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12">
                <div class="d-flex justify-content-end">
                    <div class="d-block">
                        <p>Lubuk Alung, <?= $fungsi->TanggalIndo(date('Y-m-d')) ?></p>
                        <p style="margin-top: -15px;">Pimpinan</p>
                        <br>
                        <br>
                        <br>
                        <p class="fw-bolder" style="font-family: 'Times New Roman', Times, serif;">
                            <?= $dataKepala['nama_pengguna'] ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->
    <?php include 'app/view/layout/script.php' ?>
    <script>
        window.print()
    </script>
    <!-- \Script -->
</body>

</html>