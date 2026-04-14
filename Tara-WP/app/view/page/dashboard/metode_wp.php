<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Head -->
    <?php include 'app/view/layout/head.php' ?>
    <!-- \Head -->
</head>

<body>
    <!-- Controller -->
    <?php include 'app/controller/dashboard/metode_wp.php' ?>
    <!-- \Controller -->

    <div class="container-scroller">
        <!-- Nav -->
        <?php include 'app/view/layout/nav.php' ?>
        <!-- \Nav -->

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- Sidebar -->
            <?php include 'app/view/layout/sidebar.php' ?>
            <!-- \Sidebar -->

            <!-- Main -->
            <div class="main-panel">
                <!-- Content -->
                <div class="content-wrapper">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h2 class="font-weight-bold">
                                Laporan Penilaian Kinerja Karyawan Menggunakan Metode Weighted Product
                            </h2>
                            <?php if (isset($_POST['cek'])) : ?>
                            <section class="d-none">
                                <h5>Semester <?= $_POST['semester'] ?> Periode <?= $_POST['periode'] ?></h5>
                            </section>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <?php if (isset($_POST['cek'])) : ?>
                                    <?php if (mysqli_num_rows($cekData) >= mysqli_num_rows($queryKriteria)) : ?>
                                    <a href="?r=Laporan&semester=<?= $_POST['semester'] ?>&periode=<?= $_POST['periode'] ?>"
                                        target="_blank" class="btn btn-primary">Cetak Laporan</a>
                                    <?php endif ?>
                                    <a href="?p=WP" class="btn btn-secondary">Reset</a>
                                    <?php else : ?>
                                    <form method="post" class="needs-validation" novalidate>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-check-label d-none">Semester</label>
                                                <select class="form-control d-none" name="semester" required>
                                                    <option value="" disabled selected>Pilih</option>
                                                    <option value="1" selected>Semester 1</option>
                                                    <option value="2">Semester 2</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-check-label d-none">Periode</label>
                                                <select class="form-control d-none" name="periode" required>
                                                    <option value="" disabled selected>Pilih</option>
                                                    <option value="2020/2021">Periode 2020/2021</option>
                                                    <option value="2021/2022">Periode 2021/2022</option>
                                                    <option value="2022/2023">Periode 2022/2023</option>
                                                    <option value="2023/2024">Periode 2023/2024</option>
                                                    <option value="2024/2025" selected>Periode 2024/2025</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" name="cek" class="btn btn-success">Cek
                                                    Data</button>
                                            </div>
                                        </div>
                                    </form>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <?php if (isset($_POST['cek'])) : ?>
                        <div class="col-md-12 grid-margin stretch-card mb-3">
                            <?php if (mysqli_num_rows(result: $cekData) >= mysqli_num_rows(result: $queryKriteria)) : ?>
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover text-center border-dark">
                                            <thead>
                                                <tr>
                                                    <th class="align-middle">Ranking</th>
                                                    <th class="align-middle">NIP Karyawan</th>
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
                                                    <th><?= $no++ ?></th>
                                                    <td><?= $row['nip'] ?></td>
                                                    <td><?= $row['nama'] ?></td>
                                                    <?php foreach ($queryKompetensi as $rowk) : ?>
                                                    <td><?= $cekGuru >= 15 ? round($wp->VektorS_Kometensi($row['id'], $rowk['kode_kompetensi'], $semester, $periode), 5) : '-' ?>
                                                    </td>
                                                    <?php endforeach ?>
                                                    <th><?= $cekGuru >= 15 ? $row['total_nilai'] : '-' ?></th>
                                                    <th><?= $cekGuru >= 15 ? $row['keputusan'] : '-' ?></th>
                                                </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?php else : ?>
                            <div class="card">
                                <div class="card-body">
                                    <h4>Belum ada penilaian atau penilaian belum cukup</h4>
                                </div>
                            </div>
                            <?php endif ?>
                        </div>
                        <?php endif ?>
                    </div>
                </div>
                <!-- \Content -->

                <!-- Footer -->
                <?php include 'app/view/layout/footer.php' ?>
                <!-- \Footer -->
            </div>
            <!-- \Main -->
        </div>
    </div>

    <!-- Script -->
    <?php include 'app/view/layout/script.php' ?>
    <!-- \Script -->
</body>

</html>